<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests\QuestionAnswers;

use App\Models\Rbac\RolesModel;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class RolesModelTest extends TestCase
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
        $result = (new RolesModel())->first();
//        print_r($result->toArray());
        static::assertNotNull($result);
        static::assertArrayHasKey('role_name', $result);

        $roleId = $result->role_id;
        $result = RolesModel::find($roleId)->users()->get();
//        print_r($result->toArray());
        static::assertNotNull($result);
        static::assertArrayHasKey(0, $result);
        static::assertArrayHasKey('pivot', $result[0]);
    }

    public function testPermissions()
    {
        $roleId = 3;
        $result = RolesModel::find($roleId)->permissions()->get();
        print_r($result->toArray());
        static::assertNotNull($result);
        static::assertArrayHasKey(0, $result);
        static::assertArrayHasKey('pivot', $result[0]);
    }
}
