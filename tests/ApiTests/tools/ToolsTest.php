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
final class ToolsTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testBasicTest()
    {
        $response = $this->post('/api/useragent');
        // echo $response->dump();
        print_r(strip_tags($response->getContent()));

        // $response->assertSuccessful();

        // $response->assertStatus(200);
    }
}
