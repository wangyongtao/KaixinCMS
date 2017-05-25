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
