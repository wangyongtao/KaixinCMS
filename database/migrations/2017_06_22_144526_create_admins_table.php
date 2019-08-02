<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->string('platform')->default('admins')->comment('platform name');
            $table->string('module')->default('posts')->comment('module name');
            $table->integer('parent_id')->default(0);
            $table->string('category_name', 50)->default('');
            $table->string('category_name_en', 50)->default('');
            $table->string('category_logo')->default('');
            $table->string('category_description')->default('');
            $table->tinyInteger('status')->default(1)->comment('[STATUS] 1:default, 0:hide, -1:delete');
            $table->string('notes')->default('');
            $table->nullableTimestamps();
        });
        // 文章表 Articles
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->default('posts')->comment('platform english name');
            $table->string('module')->default('posts')->comment('module english name');
            $table->string('category')->default('default')->comment('category english name');
            $table->string('title')->default('');
            $table->string('author')->default('');
            $table->string('slug')->default('');
            $table->string('source_name')->default('source_name');
            $table->string('source_link')->default('source_link');
            $table->longText('content');
            $table->unsignedInteger('post_id')->default(0)->comment('post_id');
            $table->unsignedInteger('views')->default(0)->comment('Views Number');
            $table->unsignedInteger('favorites')->default(0)->comment('Favorite Number');
            $table->unsignedInteger('thumb_up')->default(0)->comment('thumb_up Number');
            $table->unsignedInteger('thumb_down')->default(0)->comment('thumb_down Number');
            $table->tinyInteger('status')->default(1)->comment('[STATUS] 1:default, 0:hide, -1:delete');
            $table->string('notes')->default('');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('audited_at')->nullable();
        });

        // 文章详细内容表 Articles Detail Content
        Schema::create('article_texts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->unsignedInteger('post_id')->default(0)->comment('post_id');
            $table->unsignedInteger('section_id')->default(0)->comment('section_id');
            $table->longText('content')->comment('content');
            $table->string('ip_address')->default('');
            $table->string('user_agent')->default('');
            $table->string('remark')->default('');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });

        // 友情链接 Frendly Links
        Schema::create('links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->default('admins')->comment('platform name');
            $table->string('module')->default('posts')->comment('module name');
            $table->string('link_name')->default('Site Name');
            $table->string('link_name_en')->default('English Name');
            $table->string('link_url')->default('');
            $table->string('link_description')->default('');
            $table->string('link_logo')->default('');
            $table->string('is_hot')->default('');
            $table->string('link_owner')->default('');
            $table->tinyInteger('status')->default(1)->comment('[STATUS] 1:default, 0:hide, -1:delete');
            $table->string('notes')->default('');
            $table->string('created_by', 100)->default('');
            $table->string('updated_by', 100)->default('');
            $table->nullableTimestamps();
        });

        // 用户操作日志表 User Opteration Logs
        Schema::create('user_operations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->default('admins')->comment('platform english name');
            $table->string('module')->default('default')->comment('module english name');
            $table->string('action')->default('')->comment('action name');
            $table->string('user_id')->default(0);
            $table->string('user_name')->default('');
            $table->string('title')->default('');
            $table->text('content');
            $table->string('ip_address')->default('');
            $table->string('user_agent')->default('');
            $table->string('created_by', 100)->default('');
            $table->dateTime('created_at');
        });

        // 用户登录日志表 User Login Logs
        Schema::create('user_login_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->default('admins')->comment('platform english name');
            $table->string('module')->default('default')->comment('module english name');
            $table->string('action')->default('login')->comment('action name');
            $table->string('user_id')->default(0);
            $table->string('user_name')->default('');
            $table->string('ip_address')->default('');
            $table->string('ip_location')->default('');
            $table->string('system', 30)->default('');
            $table->string('brower', 30)->default('');
            $table->string('device', 30)->default('');
            $table->string('user_agent')->default('');
            $table->string('is_mobile')->default('');
            $table->dateTime('created_at');
        });

        Schema::create('user_meta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->default('posts')->comment('platform english name');
            $table->string('module')->default('posts')->comment('module english name');
            $table->string('mobile')->default('');
            $table->string('description')->default('');
            $table->string('website')->default('');
            $table->tinyInteger('status')->default(1)->comment('[STATUS] 1:default, 0:hide, -1:delete');
            $table->string('notes')->default('');
            $table->string('created_by', 100)->default('');
            $table->string('updated_by', 100)->default('');
            $table->nullableTimestamps();
        });

        Schema::create('todolist', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->default('todolist')->comment('platform english name');
            $table->string('module')->default('todolist')->comment('module english name');
            $table->string('category')->default('default')->comment('category english name');
            $table->string('parent_id')->default('Parent Todo ID');
            $table->string('user_id')->default('');
            $table->string('title')->default('');
            $table->text('content');
            $table->integer('start_time')->default(0);
            $table->integer('end_time')->default(0);
            $table->integer('deadline')->default(0);
            $table->enum('progress', ['waiting', 'delay', 'doing', 'done', 'cancel', 'closed'])
                ->default('waiting')
                ->comment('progress')
            ;
            $table->bigInteger('favorites')->default(0)->comment('Favorite Number');
            $table->tinyInteger('is_private')->default(0);
            $table->tinyInteger('is_mark')->default(0);
            $table->tinyInteger('status')->default(1)->comment('[STATUS] 1:default, 0:hide, -1:delete');
            $table->string('notes')->default('');
            $table->string('created_by', 100)->default('');
            $table->string('updated_by', 100)->default('');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable()->useCurrent();
        });

        // Tagas
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->default('admins')->comment('platform name');
            $table->string('module')->default('posts')->comment('module name');
            $table->string('tag_name')->default('Site Name');
            $table->string('tag_name_en')->default('English Name');
            $table->string('tag_description')->default('');
            $table->string('notes')->default('');
            $table->tinyInteger('status')->default(1)->comment('[STATUS] 1:default, 0:hide, -1:delete');
            $table->string('created_by', 100)->default('');
            $table->string('updated_by', 100)->default('');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable()->useCurrent();
        });

        Schema::create('tag_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->default('admins')->comment('platform name');
            $table->string('module')->default('posts')->comment('module name');
            $table->string('tag_id')->default('Tag ID');
            $table->string('object_id')->default('Object ID');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable()->useCurrent();
        });

        // pages
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->default('posts')->comment('platform english name');
            $table->string('module')->default('posts')->comment('module english name');
            $table->string('category')->default('default')->comment('category english name');
            $table->string('title')->default('');
            $table->string('author')->default('');
            $table->string('slug')->default('');
            $table->mediumText('content');
            $table->bigInteger('views')->default(0)->comment('Views Number');
            $table->bigInteger('favorites')->default(0)->comment('Favorite Number');
            $table->bigInteger('thumb_up')->default(0)->comment('thumb_up Number');
            $table->bigInteger('thumb_down')->default(0)->comment('thumb_down Number');
            $table->string('notes')->default('');
            $table->tinyInteger('status')->default(1)->comment('[STATUS] 1:default, 0:hide, -1:delete');
            $table->string('created_by', 100)->default('');
            $table->string('updated_by', 100)->default('');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable()->useCurrent();
        });

        // settings
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->default('posts')->comment('platform english name');
            $table->string('module')->default('posts')->comment('module english name');
            $table->string('title')->default('');
            $table->mediumText('content');
            $table->string('notes')->default('');
            $table->tinyInteger('status')->default(1)->comment('[STATUS] 1:default, 0:hide, -1:delete');
            $table->string('created_by', 100)->default('');
            $table->string('updated_by', 100)->default('');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable()->useCurrent();
        });

        // 用户意见反馈 advice or feedback
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 30);
            $table->integer('uid')->default(0);
            $table->string('username')->default('');
            $table->string('module')->default('posts')->comment('module english name');
            $table->string('title')->default('');
            $table->string('content')->default('');
            $table->string('notes')->default('');
            $table->string('user_agent')->default('');
            $table->string('ip_address')->default('');
            $table->string('device')->default('');
            $table->string('browser')->default('');
            $table->string('platform')->default('');
            $table->string('contact_info')->default('');
            $table->tinyInteger('status')->default(1)->comment('[STATUS] 1:default, 0:hide, -1:delete');
            $table->string('created_by', 100)->default('');
            $table->string('updated_by', 100)->default('');
            // index
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable()->useCurrent();
        });

        // 权限表
        Schema::create('rbac_permissions', function (Blueprint $table) {
            $table->increments('permission_id');
            $table->string('module')->default('');
            $table->string('permission_name')->unique();
            $table->string('permission_slug')->unique();
            $table->string('description')->default('');
            $table->tinyInteger('status')->default(1);
            $table->string('remark')->default('');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable()->useCurrent();
            // index
            $table->unique(['permission_name', 'permission_slug']);
        });

        // 角色表
        Schema::create('rbac_roles', function (Blueprint $table) {
            $table->increments('role_id');
            $table->string('role_name')->unique();
            $table->string('role_slug')->unique();
            $table->text('permissions');
            $table->string('description')->default('');
            $table->tinyInteger('status')->default(1);
            $table->string('remark')->default('');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable()->useCurrent();
        });

        // 用户与角色关系表
        Schema::create('rbac_user_role', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('role_id');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable()->useCurrent();
            // index
            $table->unique(['user_id', 'role_id']);
        });

        // 角色与权限关系表
        Schema::create('rbac_role_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('permission_id');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable()->useCurrent();
            // index
            $table->unique(['role_id', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Schema::dropIfExists('categories');
    }
}
