<?php

namespace Tests\Posts;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Watercart\Shoppingcart\Cart;
// use Watercart\Shoppingcart\CartFacade;

class PostsTest extends TestCase
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

    public function testPostTest()
    {
        $obj = (new Cart() );
        $obj->user_id = 1;
        $obj->goods_id = 2;
        $obj->number = 3;
        $obj->final_price = 100;
        $obj->discount_amount = 300;
        $obj->save();

        print_r($obj->toArray());

         // Watercart\Shoppingcart;
        $res = Cart::find(1);
        print_r($res->toArray());

Cart::test();

        $this->assertTrue(true);
    }
}
