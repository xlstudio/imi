<?php

declare(strict_types=1);

namespace Imi\Server\TcpServer\Middleware;

use Imi\Server\TcpServer\IReceiveHandler;
use Imi\Server\TcpServer\Message\IReceiveData;

interface IMiddleware
{
    public function process(IReceiveData $data, IReceiveHandler $handler): mixed;
}
