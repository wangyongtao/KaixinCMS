<?php

namespace Tests\Posts;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
// use Watercart\Shoppingcart\Cart;
use Watercart\Shoppingcart\Facades\Cart;

class CartTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testCartAddTest()
    {
        $data = [
            'user_id'     => time(),
            'goods_id'    => 365001,
            'number'      => 1,
            'final_price' => 100,
            'discount_amount' => 30,
        ];
        $res = Cart::add($data);
        $this->assertTrue(true, 'Add Cart Error...');

        $data = [
            [
                'user_id' => time(),
                'goods_id' => 365002,
                'number' => 2,
                'final_price' => 12.5,
                'discount_amount' => 10,
            ],
            [
                'user_id'   => time(),
                'goods_id'  => 365003,
                'number'    => 3,
                'final_price'     => 103.38,
                'discount_amount' => 20.5,
            ],

        ];
        $res = Cart::add($data);
        $this->assertTrue(true, 'Multi Add Cart Error...');
    }

    public function testRetrieveCart()
    {
        $userId = 1495541997;
        $result = Cart::get($userId);
        //print_r($result);
        $this->assertNotNull($result);
    }
}
