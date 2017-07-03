<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
        	$table->increments('id');
            $table->string('title');
            $table->string('category');
            $table->longText('content');
            $table->tinyInteger('status')->default(1)->comment('status: 1:default, 0:hide, -1:delete');
            $table->nullableTimestamps();
        });

        Schema::create('post_category', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type')->default(1)->comment('type:');
            $table->integer('pid');   
            $table->string('name', 50);
            $table->string('name_en', 50);
            $table->string('category');
            $table->tinyInteger('status')->default(1)->comment('status: 1:default, 0:hide, -1:delete');
            $table->nullableTimestamps();
        });

        // Schema::create('post_tags_relation', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('title');
        //     $table->string('category');
        //     $table->longText('content');
        //     $table->nullableTimestamps();

        // });
        // Schema::create('post_tags_relation', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('title');
        //     $table->string('category');
        //     $table->longText('content');
        //     $table->nullableTimestamps();

        // });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');    
    }
}
