<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(\Config::get('shoppingcart.goods_table'), function (Blueprint $table) {
            $table->unsignedInteger('goods_id')->comment('goods_id');   
            $table->unsignedInteger('goods_code')->default(0)->comment('goods_code');
            $table->unsignedInteger('brand_id')->default(0)->comment('brand_id');   
            $table->string('title')->default('')->comment('title');   
            $table->string('image')->default('')->comment('主图');   
            $table->decimal('selling_price', 5, 2)->default(0.00)->comment('普通销售价');
            $table->decimal('market_price', 5, 2)->default(0.00)->comment('市场指导价');
            $table->unsignedInteger('weight')->default(0)->comment('weight');
            $table->unsignedInteger('favorite_num')->default(0)->comment('favorite_num');
            $table->unsignedInteger('comment_num')->default(0)->comment('comment_num');
            $table->unsignedInteger('sale_num')->default(0)->comment('sale_num');
            $table->unsignedTinyInteger('is_hot')->default(0)->comment('is_hot');
            $table->unsignedTinyInteger('is_promotion')->default(0)->comment('is_hot');
            $table->unsignedTinyInteger('is_on_sale')->default(1)->comment('is_on_sale');
            $table->tinyInteger('status')->default(1)->comment('status: 1:default, 0:hide, -1:delete');
            $table->nullableTimestamps();
        });

        Schema::create(\Config::get('shoppingcart.goods_description_table'), function (Blueprint $table) {
            $table->integer('goods_id')->comment('goods_id');   
            $table->text('content')->comment('description');
            $table->string('vendor_name')->default('')->comment('vendor_name');
            $table->string('vendor_address')->default('')->comment('vendor_address');
            $table->string('vendor_email')->default('')->comment('vendor_email');
            $table->string('vendor_phone')->default('')->comment('vendor_phone');
            $table->nullableTimestamps();
        });

    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(\Config::get('shoppingcart.goods_table'));    
        Schema::dropIfExists(\Config::get('shoppingcart.goods_description_table'));    
    }
}
