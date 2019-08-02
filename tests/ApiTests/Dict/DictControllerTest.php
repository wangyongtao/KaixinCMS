<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests;

/**
 * @internal
 * @coversNothing
 */
final class DictControllerTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testBasicTest()
    {
        static::assertTrue(true);

        $response = $this->post('/api/dict/test1/test2/notfound');
        $response->assertStatus(404);
    }

    public function testGetList()
    {
        $response = $this->post('/api/dict/words');
        // echo $response->dump();
        print_r(json_decode($response->getContent(), true));

        $response->assertSuccessful();
        $response->assertStatus(200);
    }
}
