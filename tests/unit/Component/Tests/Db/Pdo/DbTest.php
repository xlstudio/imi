<?php

declare(strict_types=1);

namespace Imi\Test\Component\Tests\Db\Pdo;

use Imi\Test\Component\Tests\Db\DbBaseTestCase;

/**
 * @testdox PDO
 */
class DbTest extends DbBaseTestCase
{
    /**
     * 连接池名.
     */
    protected ?string $poolName = 'maindb';
}
