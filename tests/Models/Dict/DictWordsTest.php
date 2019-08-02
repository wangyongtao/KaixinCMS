<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests\Models;

use App\Models\Dict\DictWordsModel;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class DictWordsTest extends TestCase
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
        $result = (new DictWordsModel())->getListWithPaginate();
        print_r($result);
    }
}
