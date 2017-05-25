<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {

        Schema::create(\Config::get('shoppingcart.cart_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0)->comment('user_id');   
            $table->unsignedInteger('goods_id')->default(0)->comment('goods_id');   
            $table->unsignedInteger('number')->default(1)->comment('购买数量'); 
            $table->decimal('final_price', 5, 2)->default(0.00)->comment('最终交易价');  
            $table->decimal('promotion_price', 5, 2)->default(0.00)->comment('促销优惠价');
            $table->decimal('promotion_id', 5, 2)->default(0.00)->comment('促销活动ID');
            $table->decimal('selling_price', 5, 2)->default(0.00)->comment('普通销售价');
            $table->decimal('market_price', 5, 2)->default(0.00)->comment('市场指导价');
            $table->decimal('discount_amount', 5, 2)->default(0.00)->comment('discount_amount');
            $table->decimal('tax', 5, 2)->default(0.00)->comment('tax');
            $table->decimal('amount', 5, 2)->default(0.00)->comment('Amount(总计) = FinalPrice最终交易价 * Number购买数量');
            $table->tinyInteger('status')->default(1)->comment('status: 1:default, 0:hide, -1:delete');
            $table->nullableTimestamps();
        });

    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(\Config::get('shoppingcart.cart_table'));    
    }
}
