<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooks extends Migration
{
    private $tablePrefix = 'kx_';

    public function getTableName($tableName = ''){
        return $this->tablePrefix . $tableName;
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 图书分类
        Schema::create( $this->getTableName('books'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('platform')->default('admins')->comment('platform name');
            $table->string('category')->default('book')->comment('category name');
            $table->string('book_name')->default('');
            $table->string('book_name_en')->default('');
            $table->string('book_logo')->default('');
            $table->string('book_description')->default('');
            $table->tinyInteger('status')->default(1)->comment('[STATUS] 1:default, 0:hide, -1:delete');
            $table->string('notes')->default('');
            $table->string('created_by', 100)->default('');
            $table->string('updated_by', 100)->default('');
            $table->nullableTimestamps();
        });

        // 图书章节
        Schema::create( $this->getTableName('book_sections'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('book_id')->default(0)->comment('book_id');   
            $table->bigInteger('text_id')->default(0)->comment('text_id');   
            $table->bigInteger('views')->default(0)->comment('Views Number');   
            $table->bigInteger('favorites')->default(0)->comment('Favorite Number');   
            $table->bigInteger('thumb_up')->default(0)->comment('thumb_up Number');   
            $table->bigInteger('thumb_down')->default(0)->comment('thumb_down Number');   
            $table->tinyInteger('status')->default(1)->comment('[STATUS] 1:default, 0:hide, -1:delete');
            $table->string('notes')->default('');
            $table->string('created_by', 100)->default('');
            $table->string('updated_by', 100)->default('');
            $table->nullableTimestamps();
        });

        // 图书内容
        Schema::create( $this->getTableName('book_texts'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('book_id')->default(0)->comment('book_id');   
            $table->bigInteger('section_id')->default(0)->comment('section_id');   
            $table->longText('content');
            $table->string('notes')->default('');
            $table->string('created_by', 100)->default('');
            $table->string('updated_by', 100)->default('');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
