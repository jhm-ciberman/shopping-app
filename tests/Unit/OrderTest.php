<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\OrderItem;

class OrderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testOrderItemDiscount()
    {
        $item = factory(OrderItem::class)->make([
            'price'    => 100,
            'discount' => 20,
            'quantity' => 2,
        ]);

        $this->assertEquals(100, $item->price);
        $this->assertEquals(20, $item->discount);
        $this->assertEquals(2, $item->quantity);

        $this->assertTrue($item->has_discount);

        $this->assertEquals(200, $item->total);
        $this->assertEquals(40, $item->total_discount);
        $this->assertEquals(160, $item->discounted_total);
    }
}
