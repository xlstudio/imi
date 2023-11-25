<?php

declare(strict_types=1);

namespace Imi\Server\Http\Message\Proxy;

use Imi\RequestContextProxy\BaseRequestContextProxy;

/**
 * @method        \Imi\Server\Http\Message\Contract\IHttpResponse                     redirect(string $url, int $status = 302)
 * @method static \Imi\Server\Http\Message\Contract\IHttpResponse                     redirect(string $url, int $status = 302)
 * @method        \Imi\Server\Http\Message\Contract\IHttpResponse                     send()
 * @method static \Imi\Server\Http\Message\Contract\IHttpResponse                     send()
 * @method        \Imi\Server\Http\Message\Contract\IHttpResponse                     sendFile(string $filename, ?string $contentType = NULL, ?string $outputFileName = NULL, int $offset = 0, int $length = 0)
 * @method static \Imi\Server\Http\Message\Contract\IHttpResponse                     sendFile(string $filename, ?string $contentType = NULL, ?string $outputFileName = NULL, int $offset = 0, int $length = 0)
 * @method        bool                                                                isHeaderWritable()
 * @method static bool                                                                isHeaderWritable()
 * @method        bool                                                                isBodyWritable()
 * @method static bool                                                                isBodyWritable()
 * @method        \Imi\Server\Http\Message\Contract\IHttpResponse                     withResponseBodyEmitter(?\Imi\Server\Http\Message\Emitter\Contract\IResponseBodyEmitter $responseBodyEmitter)
 * @method static \Imi\Server\Http\Message\Contract\IHttpResponse                     withResponseBodyEmitter(?\Imi\Server\Http\Message\Emitter\Contract\IResponseBodyEmitter $responseBodyEmitter)
 * @method        \Imi\Server\Http\Message\Contract\IHttpResponse                     setResponseBodyEmitter(?\Imi\Server\Http\Message\Emitter\Contract\IResponseBodyEmitter $responseBodyEmitter)
 * @method static \Imi\Server\Http\Message\Contract\IHttpResponse                     setResponseBodyEmitter(?\Imi\Server\Http\Message\Emitter\Contract\IResponseBodyEmitter $responseBodyEmitter)
 * @method        \Imi\Server\Http\Message\Emitter\Contract\IResponseBodyEmitter|null getResponseBodyEmitter()
 * @method static \Imi\Server\Http\Message\Emitter\Contract\IResponseBodyEmitter|null getResponseBodyEmitter()
 * @method        \Imi\Util\Http\Contract\IResponse                                   setStatus(int $code, string $reasonPhrase = '')
 * @method static \Imi\Util\Http\Contract\IResponse                                   setStatus(int $code, string $reasonPhrase = '')
 * @method        \Imi\Util\Http\Contract\IResponse                                   withCookie(string $key, string $value, int $expire = 0, string $path = '/', string $domain = '', bool $secure = false, bool $httponly = false)
 * @method static \Imi\Util\Http\Contract\IResponse                                   withCookie(string $key, string $value, int $expire = 0, string $path = '/', string $domain = '', bool $secure = false, bool $httponly = false)
 * @method        \Imi\Util\Http\Contract\IResponse                                   setCookie(string $key, string $value, int $expire = 0, string $path = '/', string $domain = '', bool $secure = false, bool $httponly = false)
 * @method static \Imi\Util\Http\Contract\IResponse                                   setCookie(string $key, string $value, int $expire = 0, string $path = '/', string $domain = '', bool $secure = false, bool $httponly = false)
 * @method        array                                                               getCookieParams()
 * @method static array                                                               getCookieParams()
 * @method        array|null                                                          getCookie(string $name, ?array $default = NULL)
 * @method static array|null                                                          getCookie(string $name, ?array $default = NULL)
 * @method        array                                                               getTrailers()
 * @method static array                                                               getTrailers()
 * @method        bool                                                                hasTrailer(string $name)
 * @method static bool                                                                hasTrailer(string $name)
 * @method        string|null                                                         getTrailer(string $name)
 * @method static string|null                                                         getTrailer(string $name)
 * @method        \Imi\Util\Http\Contract\IResponse                                   withTrailer(string $name, string $value)
 * @method static \Imi\Util\Http\Contract\IResponse                                   withTrailer(string $name, string $value)
 * @method        \Imi\Util\Http\Contract\IResponse                                   setTrailer(string $name, string $value)
 * @method static \Imi\Util\Http\Contract\IResponse                                   setTrailer(string $name, string $value)
 * @method        int                                                                 getStatusCode()
 * @method static int                                                                 getStatusCode()
 * @method        \Psr\Http\Message\ResponseInterface                                 withStatus(int $code, string $reasonPhrase = '')
 * @method static \Psr\Http\Message\ResponseInterface                                 withStatus(int $code, string $reasonPhrase = '')
 * @method        string                                                              getReasonPhrase()
 * @method static string                                                              getReasonPhrase()
 * @method        string                                                              getProtocolVersion()
 * @method static string                                                              getProtocolVersion()
 * @method        \Psr\Http\Message\MessageInterface                                  withProtocolVersion(string $version)
 * @method static \Psr\Http\Message\MessageInterface                                  withProtocolVersion(string $version)
 * @method        string[][]                                                          getHeaders()
 * @method static string[][]                                                          getHeaders()
 * @method        bool                                                                hasHeader(string $name)
 * @method static bool                                                                hasHeader(string $name)
 * @method        string[]                                                            getHeader(string $name)
 * @method static string[]                                                            getHeader(string $name)
 * @method        string                                                              getHeaderLine(string $name)
 * @method static string                                                              getHeaderLine(string $name)
 * @method        \Psr\Http\Message\MessageInterface                                  withHeader(string $name, $value)
 * @method static \Psr\Http\Message\MessageInterface                                  withHeader(string $name, $value)
 * @method        \Psr\Http\Message\MessageInterface                                  withAddedHeader(string $name, $value)
 * @method static \Psr\Http\Message\MessageInterface                                  withAddedHeader(string $name, $value)
 * @method        \Psr\Http\Message\MessageInterface                                  withoutHeader(string $name)
 * @method static \Psr\Http\Message\MessageInterface                                  withoutHeader(string $name)
 * @method        \Psr\Http\Message\StreamInterface                                   getBody()
 * @method static \Psr\Http\Message\StreamInterface                                   getBody()
 * @method        \Psr\Http\Message\MessageInterface                                  withBody(\Psr\Http\Message\StreamInterface $body)
 * @method static \Psr\Http\Message\MessageInterface                                  withBody(\Psr\Http\Message\StreamInterface $body)
 * @method        \Imi\Util\Http\Contract\IMessage                                    setProtocolVersion(string $version)
 * @method static \Imi\Util\Http\Contract\IMessage                                    setProtocolVersion(string $version)
 * @method        \Imi\Util\Http\Contract\IMessage                                    setHeader(string $name, array|string $value)
 * @method static \Imi\Util\Http\Contract\IMessage                                    setHeader(string $name, array|string $value)
 * @method        \Imi\Util\Http\Contract\IMessage                                    addHeader(string $name, array|string $value)
 * @method static \Imi\Util\Http\Contract\IMessage                                    addHeader(string $name, array|string $value)
 * @method        \Imi\Util\Http\Contract\IMessage                                    removeHeader(string $name)
 * @method static \Imi\Util\Http\Contract\IMessage                                    removeHeader(string $name)
 * @method        \Imi\Util\Http\Contract\IMessage                                    setBody(\Psr\Http\Message\StreamInterface $body)
 * @method static \Imi\Util\Http\Contract\IMessage                                    setBody(\Psr\Http\Message\StreamInterface $body)
 */
#[
    \Imi\RequestContextProxy\Annotation\RequestContextProxy(class: \Imi\Server\Http\Message\Contract\IHttpResponse::class, name: 'response'),
    \Imi\Bean\Annotation\Bean(name: 'HttpResponseProxy')
]
class ResponseProxyObject extends BaseRequestContextProxy implements \Imi\Server\Http\Message\Contract\IHttpResponse
{
    /**
     * {@inheritDoc}
     */
    public function redirect(string $url, int $status = 302): \Imi\Server\Http\Message\Contract\IHttpResponse
    {
        return self::__getProxyInstance()->redirect($url, $status);
    }

    /**
     * {@inheritDoc}
     */
    public function send(): \Imi\Server\Http\Message\Contract\IHttpResponse
    {
        return self::__getProxyInstance()->send(...\func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function sendFile(string $filename, ?string $contentType = null, ?string $outputFileName = null, int $offset = 0, int $length = 0): \Imi\Server\Http\Message\Contract\IHttpResponse
    {
        return self::__getProxyInstance()->sendFile($filename, $contentType, $outputFileName, $offset, $length);
    }

    /**
     * {@inheritDoc}
     */
    public function isHeaderWritable(): bool
    {
        return self::__getProxyInstance()->isHeaderWritable(...\func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function isBodyWritable(): bool
    {
        return self::__getProxyInstance()->isBodyWritable(...\func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function withResponseBodyEmitter(?\Imi\Server\Http\Message\Emitter\Contract\IResponseBodyEmitter $responseBodyEmitter): \Imi\Server\Http\Message\Contract\IHttpResponse
    {
        return self::__getProxyInstance()->withResponseBodyEmitter($responseBodyEmitter);
    }

    /**
     * {@inheritDoc}
     */
    public function setResponseBodyEmitter(?\Imi\Server\Http\Message\Emitter\Contract\IResponseBodyEmitter $responseBodyEmitter): \Imi\Server\Http\Message\Contract\IHttpResponse
    {
        return self::__getProxyInstance()->setResponseBodyEmitter($responseBodyEmitter);
    }

    /**
     * {@inheritDoc}
     */
    public function getResponseBodyEmitter(): ?\Imi\Server\Http\Message\Emitter\Contract\IResponseBodyEmitter
    {
        return self::__getProxyInstance()->getResponseBodyEmitter(...\func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus(int $code, string $reasonPhrase = ''): \Imi\Util\Http\Contract\IResponse
    {
        return self::__getProxyInstance()->setStatus($code, $reasonPhrase);
    }

    /**
     * {@inheritDoc}
     */
    public function withCookie(string $key, string $value, int $expire = 0, string $path = '/', string $domain = '', bool $secure = false, bool $httponly = false): \Imi\Util\Http\Contract\IResponse
    {
        return self::__getProxyInstance()->withCookie($key, $value, $expire, $path, $domain, $secure, $httponly);
    }

    /**
     * {@inheritDoc}
     */
    public function setCookie(string $key, string $value, int $expire = 0, string $path = '/', string $domain = '', bool $secure = false, bool $httponly = false): \Imi\Util\Http\Contract\IResponse
    {
        return self::__getProxyInstance()->setCookie($key, $value, $expire, $path, $domain, $secure, $httponly);
    }

    /**
     * {@inheritDoc}
     */
    public function getCookieParams(): array
    {
        return self::__getProxyInstance()->getCookieParams(...\func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function getCookie(string $name, ?array $default = null): ?array
    {
        return self::__getProxyInstance()->getCookie($name, $default);
    }

    /**
     * {@inheritDoc}
     */
    public function getTrailers(): array
    {
        return self::__getProxyInstance()->getTrailers(...\func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function hasTrailer(string $name): bool
    {
        return self::__getProxyInstance()->hasTrailer($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getTrailer(string $name): ?string
    {
        return self::__getProxyInstance()->getTrailer($name);
    }

    /**
     * {@inheritDoc}
     */
    public function withTrailer(string $name, string $value): \Imi\Util\Http\Contract\IResponse
    {
        return self::__getProxyInstance()->withTrailer($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function setTrailer(string $name, string $value): \Imi\Util\Http\Contract\IResponse
    {
        return self::__getProxyInstance()->setTrailer($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatusCode(): int
    {
        return self::__getProxyInstance()->getStatusCode(...\func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function withStatus(int $code, string $reasonPhrase = ''): \Psr\Http\Message\ResponseInterface
    {
        return self::__getProxyInstance()->withStatus($code, $reasonPhrase);
    }

    /**
     * {@inheritDoc}
     */
    public function getReasonPhrase(): string
    {
        return self::__getProxyInstance()->getReasonPhrase(...\func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function getProtocolVersion(): string
    {
        return self::__getProxyInstance()->getProtocolVersion(...\func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function withProtocolVersion(string $version): \Psr\Http\Message\MessageInterface
    {
        return self::__getProxyInstance()->withProtocolVersion($version);
    }

    /**
     * {@inheritDoc}
     */
    public function getHeaders(): array
    {
        return self::__getProxyInstance()->getHeaders(...\func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function hasHeader(string $name): bool
    {
        return self::__getProxyInstance()->hasHeader($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getHeader(string $name): array
    {
        return self::__getProxyInstance()->getHeader($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getHeaderLine(string $name): string
    {
        return self::__getProxyInstance()->getHeaderLine($name);
    }

    /**
     * {@inheritDoc}
     */
    public function withHeader(string $name, $value): \Psr\Http\Message\MessageInterface
    {
        return self::__getProxyInstance()->withHeader($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function withAddedHeader(string $name, $value): \Psr\Http\Message\MessageInterface
    {
        return self::__getProxyInstance()->withAddedHeader($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function withoutHeader(string $name): \Psr\Http\Message\MessageInterface
    {
        return self::__getProxyInstance()->withoutHeader($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getBody(): \Psr\Http\Message\StreamInterface
    {
        return self::__getProxyInstance()->getBody(...\func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function withBody(\Psr\Http\Message\StreamInterface $body): \Psr\Http\Message\MessageInterface
    {
        return self::__getProxyInstance()->withBody($body);
    }

    /**
     * {@inheritDoc}
     */
    public function setProtocolVersion(string $version): \Imi\Util\Http\Contract\IMessage
    {
        return self::__getProxyInstance()->setProtocolVersion($version);
    }

    /**
     * {@inheritDoc}
     */
    public function setHeader(string $name, array|string $value): \Imi\Util\Http\Contract\IMessage
    {
        return self::__getProxyInstance()->setHeader($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function addHeader(string $name, array|string $value): \Imi\Util\Http\Contract\IMessage
    {
        return self::__getProxyInstance()->addHeader($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function removeHeader(string $name): \Imi\Util\Http\Contract\IMessage
    {
        return self::__getProxyInstance()->removeHeader($name);
    }

    /**
     * {@inheritDoc}
     */
    public function setBody(\Psr\Http\Message\StreamInterface $body): \Imi\Util\Http\Contract\IMessage
    {
        return self::__getProxyInstance()->setBody($body);
    }
}
