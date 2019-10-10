<?php

use App\User;
use App\OrderItem;
use App\Order;
use App\Product;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::inRandomOrder()->get()->each(function ($user) {
            $this->createOrder($user);
        });

    }

    protected function createOrder($user)
    {
        $order = factory(Order::class)->create([
            'user_id' => $user->id,
        ]);

        $number = random_int(1, 3);
        Product::inRandomOrder()->take($number)->get()->each(function() use ($order) {
            factory(OrderItem::class)->create([
                'order_id' => $order->id,
            ]);
        });
    }
}
