<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests\QuestionAnswers;

use App\Models\Rbac\UsersModel;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class UserModelTest extends TestCase
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
        $user = (new UsersModel())->orderBy('id', 'DESC')->first();
        static::assertNotNull($user);
        static::assertArrayHasKey('id', $user);
        $userId = $user->id;
        var_dump($userId);

        $user = UsersModel::find($userId)->roles()->get();
        print_r($user->toArray());
        static::assertNotNull($user);
    }

    public function testHasPermission()
    {
        $userId = 1003;
        $user = UsersModel::find($userId);

        $result = $user->hasAccess('post-create');
        var_dump($result);
        static::assertTrue($result);

        $result = $user->hasAccess('post-create-none');
        var_dump($result);
        static::assertFalse($result);
    }
}
