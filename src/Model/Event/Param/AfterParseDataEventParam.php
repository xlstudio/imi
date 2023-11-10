<?php

declare(strict_types=1);

namespace Imi\Model\Event\Param;

use Imi\Event\EventParam;

class AfterParseDataEventParam extends EventParam
{
    /**
     * 处理前的数据.
     */
    public object|array $data;

    /**
     * 对象或模型类名.
     */
    public object|string $object;

    /**
     * 处理结果.
     */
    public \Imi\Util\LazyArrayObject $result;
}
