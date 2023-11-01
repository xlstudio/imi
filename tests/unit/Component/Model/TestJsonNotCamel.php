<?php

declare(strict_types=1);

namespace Imi\Test\Component\Model;

use Imi\Bean\Annotation\Inherit;
use Imi\Model\Annotation\Entity;
use Imi\Test\Component\Model\Base\TestJsonBase;

/**
 * tb_test_json.
 *
 * @property \Imi\Util\LazyArrayObject|array $jsonData json数据
 */
#[Inherit]
#[Entity(camel: false)]
class TestJsonNotCamel extends TestJsonBase
{
}
