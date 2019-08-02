<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests\Services;

use App\Services\OAuth\Providers\OschinaProvider;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class OschinaProvider extends TestCase
{
    public function testBasic()
    {
        static::assertTrue(true);
    }

    public function testGetPostList()
    {
        $code = '614181dc9334bafb3c04';
        $result = (new self())->getUserInfo($code);
        print_r($result);
    }
}
