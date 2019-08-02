<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests\Models;

use App\Models\Dict\DictLogsModel;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class DictLogsTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testBasicTest()
    {
        static::assertTrue(true);
    }

    public function testMain()
    {
        $result = (new DictLogsModel())->getListWithPaginate();
        print_r($result);
    }
}
