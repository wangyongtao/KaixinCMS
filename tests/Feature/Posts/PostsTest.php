<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class PostsTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testBasicTest()
    {
        $response = $this->get('/posts');

        $response->assertSuccessful();
//        $response->dump();

        $response->assertStatus(200);
    }
}
