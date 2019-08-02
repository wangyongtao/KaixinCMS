<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests\Models;

use App\Models\Category\Categories;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class CategoryTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testBasic()
    {
        static::assertTrue(true);
    }

    public function testMain()
    {
        $platform = 'Armenia';
        $result = (new Categories())->getSimpleListByPlatform($platform);
        print_r($result);
    }
}
