<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->string('accountname')->unique()->default('')->comment('accountname:字母数字下划线');
            $table->string('nickname')->default('')->comment('用户昵称');
            $table->string('realname')->default('')->comment('真实姓名');
            $table->string('mobilephone')->default('')->comment('mobile-phone');
            $table->integer('register_ip')->default(0)->comment('register-ip');
            $table->integer('register_time')->default(0)->comment('register-time');
            $table->string('last_ip')->default('')->comment('last-login-ip');
            $table->integer('last_time')->default(0)->comment('last-login-time');
            $table->string('email')->unique()->comment('register-email-account');
            $table->string('password');
            $table->tinyInteger('is_admin')->default(0)->comment('is-admin-account: 1:yes 0:no');;
            $table->tinyInteger('is_delete')->default(0)->comment('is-delete-account: 1:yes 0:no');;
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_login', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id')->default(0)->comment('user-id');
            $table->string('login_ip', 30)->comment('login-ip');
            $table->string('login_place', 30)->comment('login-place');
            $table->string('user_agent', 255)->comment('login-useragent');
            $table->string('platform', 30)->comment('login-platform');
            $table->string('platfor_mversion', 30)->comment('login-platform-version');
            $table->string('brower', 30)->comment('login-platform');
            $table->string('brower_version', 30)->comment('login-brower-version');
            $table->string('device', 30)->comment('login-device');
            $table->string('source', 255)->comment('login-source');
            $table->dateTime('created_at'); 
        });

        Schema::create('user_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0)->comment('user-id');
            $table->string('module', 50)->comment('action');
            $table->string('action', 50)->comment('action');
            $table->string('description', 255)->comment('description');
            $table->string('user_agent', 255)->comment('login-useragent');
            $table->text('content')->comment('detail-content');
            $table->dateTime('created_at'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
