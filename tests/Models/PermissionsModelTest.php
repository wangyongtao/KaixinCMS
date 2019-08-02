<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests\QuestionAnswers;

use App\Models\Rbac\PermissionsModel;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class PermissionsModelTest extends TestCase
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
        $result = (new PermissionsModel())->first();
//        print_r($result->toArray());
        static::assertNotNull($result);
        static::assertArrayHasKey('permission_name', $result);

//        $roleId = $result->permission_id;
        $roleId = 2;
        $result = PermissionsModel::find($roleId)->roles()->get();
        print_r($result->toArray());
        static::assertNotNull($result);
        static::assertArrayHasKey(0, $result);
        static::assertArrayHasKey('pivot', $result[0]);
    }
}
