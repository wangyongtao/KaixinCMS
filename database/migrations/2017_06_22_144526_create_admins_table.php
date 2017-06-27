<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    public $tablePrefix = 'watercart_';

    public function __construct() {
        $tablePrefix = \Config::get('admins.tablePrefix');
        if ($tablePrefix) {
            $this->tablePrefix = $tablePrefix;
        }
    }

    public function getTableName($tableName = ''){
        return $this->tablePrefix . \Config::get('admins.tableName.' . $tableName);
    }

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create( $this->getTableName('categories'), function (Blueprint $table) {
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
            $table->string('created_by', 100)->default('');
            $table->string('updated_by', 100)->default('');
            $table->nullableTimestamps();
        });

        Schema::create( $this->getTableName('posts'), function (Blueprint $table) {
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
            $table->bigInteger('post_id')->default(0)->comment('post_id');   
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

        Schema::create( $this->getTableName('links'), function (Blueprint $table) {
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

        Schema::create( $this->getTableName('operation_logs'), function (Blueprint $table) {
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

        Schema::create( $this->getTableName('user_login_logs'), function (Blueprint $table) {
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

        Schema::create( $this->getTableName('user_meta'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->default('posts')->comment('platform english name');
            $table->string('module')->default('posts')->comment('module english name');
            $table->string('mobilephone')->default('');
            $table->string('description')->default('');
            $table->string('website')->default('');
            $table->tinyInteger('status')->default(1)->comment('[STATUS] 1:default, 0:hide, -1:delete');
            $table->string('notes')->default('');
            $table->string('created_by', 100)->default('');
            $table->string('updated_by', 100)->default('');
            $table->nullableTimestamps();
        });

        Schema::create( $this->getTableName('todolist'), function (Blueprint $table) {
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
            $table->enum('progress', ['waiting','delay','doing','done','cancel','closed'])->default('waiting')->comment('progress');   
            $table->bigInteger('favorites')->default(0)->comment('Favorite Number');   
            $table->tinyInteger('is_private')->default(0);
            $table->tinyInteger('is_mark')->default(0);
            $table->tinyInteger('status')->default(1)->comment('[STATUS] 1:default, 0:hide, -1:delete');
            $table->string('notes')->default('');
            $table->string('created_by', 100)->default('');
            $table->string('updated_by', 100)->default('');
            $table->nullableTimestamps();
        });

        // Tagas
        Schema::create( $this->getTableName('tags'), function (Blueprint $table) {
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
            $table->nullableTimestamps();
        });
        Schema::create( $this->getTableName('tag_relations'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->default('admins')->comment('platform name');
            $table->string('module')->default('posts')->comment('module name');
            $table->string('tag_id')->default('Tag ID');
            $table->string('object_id')->default('Object ID');
            $table->nullableTimestamps();
        });

        // pages
        Schema::create( $this->getTableName('pages'), function (Blueprint $table) {
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
            $table->nullableTimestamps();
        });

        // settings
        Schema::create( $this->getTableName('settings'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->default('posts')->comment('platform english name');
            $table->string('module')->default('posts')->comment('module english name');
            $table->string('title')->default('');
            $table->mediumText('content');
            $table->string('notes')->default('');
            $table->tinyInteger('status')->default(1)->comment('[STATUS] 1:default, 0:hide, -1:delete');
            $table->string('created_by', 100)->default('');
            $table->string('updated_by', 100)->default('');
            $table->nullableTimestamps();
        });

        // settings
        Schema::create( $this->getTableName('feedback'), function (Blueprint $table) {
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
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists($this->getTableName('admins.tableName.categories'));  
        Schema::dropIfExists($this->getTableName('admins.tableName.posts'));    
        Schema::dropIfExists($this->getTableName('admins.tableName.pages'));    
        Schema::dropIfExists($this->getTableName('admins.tableName.links'));    
        Schema::dropIfExists($this->getTableName('admins.tableName.tags'));    
        Schema::dropIfExists($this->getTableName('admins.tableName.tag_relations'));    
        Schema::dropIfExists($this->getTableName('admins.tableName.operation_logs'));    
        Schema::dropIfExists($this->getTableName('admins.tableName.user_login_logs'));    
        Schema::dropIfExists($this->getTableName('admins.tableName.user_meta'));    
        Schema::dropIfExists($this->getTableName('admins.tableName.todolist'));    
        Schema::dropIfExists($this->getTableName('admins.tableName.settings'));    
        Schema::dropIfExists($this->getTableName('admins.tableName.feedback'));    
    }
}
