<?php

declare(strict_types=1);

namespace Imi\Pool;

use Imi\Bean\BeanFactory;
use Imi\Config;
use Imi\Event\Event;
use Imi\Log\Log;
use Imi\Pool\Interfaces\IPool;
use Imi\Pool\Interfaces\IPoolResource;
use Imi\RequestContext;

class PoolManager
{
    use \Imi\Util\Traits\TStaticClass;

    /**
     * \池子数组.
     *
     * @var \Imi\Pool\Interfaces\IPool[]
     */
    protected static array $pools = [];

    /**
     * 最后获取资源时间.
     */
    protected static array $lastGetResourceTime = [];

    /**
     * 是否初始化.
     */
    protected static bool $inited = false;

    public static function init(): void
    {
        foreach (Config::getAliases() as $alias)
        {
            foreach (Config::get($alias . '.pools', []) as $poolName => $poolConfig)
            {
                if (!isset($poolConfig['pool']))
                {
                    continue;
                }
                $poolPool = $poolConfig['pool'];
                self::addName($poolName, $poolPool['class'], new PoolConfig($poolPool['config'] ?? []), $poolConfig['resource'] ?? null);
            }
        }
        self::$inited = true;
    }

    /**
     * 检查连接池资源可用性.
     */
    public static function checkPoolResource(): bool
    {
        $result = true;
        foreach (Config::getAliases() as $alias)
        {
            foreach (Config::get($alias . '.pools', []) as $poolName => $poolConfig)
            {
                if (!isset($poolConfig['pool']))
                {
                    continue;
                }
                $poolPool = $poolConfig['pool'];
                /** @var IPool $pool */
                $pool = BeanFactory::newInstance($poolPool['class'], $poolName, new PoolConfig($poolPool['config'] ?? []), $poolConfig['resource'] ?? null);
                try
                {
                    $resource = $pool->createNewResource();
                    if (!($resource->open() && $resource->checkState()))
                    {
                        Log::error(sprintf('The resources of connection pool [%s] are not available', $poolName));
                        $result = false;
                    }
                }
                catch (\Throwable $th)
                {
                    Log::error($th);
                    Log::error(sprintf('The resources of connection pool [%s] are not available', $poolName));
                    $result = false;
                }
            }
        }

        Event::trigger('IMI.CHECK_POOL_RESOURCE', [
            'result' => &$result,
        ]);

        return $result;
    }

    /**
     * 增加对象名称.
     */
    public static function addName(string $name, string $poolClassName, Interfaces\IPoolConfig $config = null, ?array $resourceConfig = null): void
    {
        static::$pools[$name] = $pool = BeanFactory::newInstance($poolClassName, $name, $config, $resourceConfig);
        $pool->open();
    }

    /**
     * 获取所有对象名称.
     *
     * @return string[]
     */
    public static function getNames(): array
    {
        return array_keys(static::$pools);
    }

    /**
     * 清空池子.
     */
    public static function clearPools(): void
    {
        if (static::$pools)
        {
            foreach (static::$pools as $pool)
            {
                $pool->close();
            }
            static::$pools = [];
        }
    }

    /**
     * 连接池是否存在.
     */
    public static function exists(string $name): bool
    {
        if (!self::$inited)
        {
            self::init();
        }

        return isset(static::$pools[$name]);
    }

    /**
     * 获取实例.
     */
    public static function getInstance(string $name): IPool
    {
        $pools = &static::$pools;
        if (!isset($pools[$name]))
        {
            if (self::$inited)
            {
                throw new \RuntimeException(sprintf('GetInstance failed, %s is not found', $name));
            }
            else
            {
                self::init();
                if (!isset($pools[$name]))
                {
                    throw new \RuntimeException(sprintf('GetInstance failed, %s is not found', $name));
                }
            }
        }

        return $pools[$name];
    }

    /**
     * 获取池子中的资源.
     */
    public static function getResource(string $name): IPoolResource
    {
        $resource = static::getInstance($name)->getResource();

        self::pushResourceToRequestContext($resource);

        static::$lastGetResourceTime[$name] = microtime(true);

        return $resource;
    }

    /**
     * 获取请求上下文资源，一个请求上下文通过此方法，只能获取同一个资源.
     */
    public static function getRequestContextResource(string $name): IPoolResource
    {
        $requestContext = RequestContext::getContext();
        $resource = $requestContext[$key = 'poolResource.' . $name] ?? null;
        if (null !== $resource)
        {
            $requestResourceCheckInterval = $resource->getPool()->getConfig()->getRequestResourceCheckInterval();
            if (($requestResourceCheckInterval <= 0 || (microtime(true) - static::$lastGetResourceTime[$name] > $requestResourceCheckInterval)) && !$resource->checkState())
            {
                $resource->getPool()->release($resource);
                $resource = null;
            }
        }
        if (null === $resource)
        {
            $resource = static::getResource($name);
            $requestContext[$key] = $resource;
        }

        return $resource;
    }

    /**
     * 尝试获取资源，获取到则返回资源，没有获取到返回false.
     */
    public static function tryGetResource(string $name): IPoolResource|bool
    {
        $resource = static::getInstance($name)->tryGetResource();
        if ($resource)
        {
            self::pushResourceToRequestContext($resource);
        }

        return $resource;
    }

    /**
     * 释放资源占用.
     */
    public static function releaseResource(IPoolResource $resource): void
    {
        self::removeResourceFromRequestContext($resource);
        $resource->getPool()->release($resource);
    }

    /**
     * 使用回调来使用池子中的资源，无需手动释放
     * 回调有两个参数：$resource(资源对象), $instance(操作实例对象，如数据库、Redis等)
     * 本方法返回值为回调的返回值
     */
    public static function use(string $name, callable $callback): mixed
    {
        $resource = static::getResource($name);
        try
        {
            return $callback($resource, $resource->getInstance());
        }
        finally
        {
            static::releaseResource($resource);
        }
    }

    /**
     * 释放当前上下文请求的未被释放的资源.
     */
    public static function destroyCurrentContext(): void
    {
        $requestContext = RequestContext::getContext();
        $poolResources = $requestContext['poolResources'] ?? [];
        if ($poolResources)
        {
            foreach ($poolResources as $resource)
            {
                $resource->getPool()->release($resource);
            }
            $requestContext['poolResources'] = [];
        }
    }

    /**
     * 请求上下文中是否存在资源.
     */
    public static function hasRequestContextResource(string $name): bool
    {
        return null !== RequestContext::get('poolResource.' . $name);
    }

    /**
     * 把资源存放到当前上下文.
     */
    private static function pushResourceToRequestContext(IPoolResource $resource): void
    {
        $requestContext = RequestContext::getContext();
        $poolResources = $requestContext['poolResources'] ?? [];
        $instance = $resource->getInstance();
        $poolResources[spl_object_id($instance)] = $resource;
        $requestContext['poolResources'] = $poolResources;
    }

    /**
     * 把资源从当前上下文删除.
     */
    private static function removeResourceFromRequestContext(IPoolResource $resource): void
    {
        $requestContext = RequestContext::getContext();
        $poolResources = $requestContext['poolResources'] ?? [];
        $instance = $resource->getInstance();
        $key = spl_object_id($instance);
        if (isset($poolResources[$key]))
        {
            unset($poolResources[$key]);
            $requestContext['poolResources'] = $poolResources;
        }

        $name = 'poolResource.' . $resource->getPool()->getName();
        $poolResource = $requestContext[$name] ?? null;
        if ($poolResource === $resource)
        {
            $requestContext[$name] = null;
        }
    }

    /**
     * 清理连接池，只允许留下指定连接池.
     *
     * @param string[] $allowList
     */
    public static function cleanAllow(array $allowList): void
    {
        foreach (self::getNames() as $poolName)
        {
            if (!\in_array($poolName, $allowList))
            {
                self::getInstance($poolName)->close();
            }
        }
    }

    /**
     * 清理连接池，只允许留下指定连接池.
     *
     * @param string[] $denyList
     */
    public static function cleanDeny(array $denyList): void
    {
        foreach (self::getNames() as $poolName)
        {
            if (\in_array($poolName, $denyList))
            {
                self::getInstance($poolName)->close();
            }
        }
    }
}
