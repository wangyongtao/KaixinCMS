<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests\Services;

use App\Services\Cms\PostService;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class PostServiceTest extends TestCase
{
    public function testBasic()
    {
        static::assertTrue(true);
    }

    public function testGetPostList()
    {
        $input = collect([
        ]);
        $result = (new PostService())->getPostList($input);
        print_r($result);
    }
}
