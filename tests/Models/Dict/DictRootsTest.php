<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests\Models;

use App\Models\Dict\DictRootsModel;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class DictRootsTest extends TestCase
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
        $result = (new DictRootsModel())->getListWithPaginate();
//        print_r($result);

        static::assertNotNull($result);
    }

    public function testMain2()
    {
        $result = DictRootsModel::select('root_first_letter', DB::raw('count(*) as total'))
            ->where('status', 1)
            ->groupBy('root_first_letter')
            ->get()
        ;
        print_r($result->pluck('total', 'root_first_letter'));

        static::assertNotNull($result);
    }
}
