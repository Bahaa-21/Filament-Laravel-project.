<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            return;
        }

        Order::all()->each(function (Order $order) use ($products) {
            $itemCount = fake()->numberBetween(1, 5);

            for ($i = 0; $i < $itemCount; $i++) {
                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $products->random()->id,
                ]);
            }
        });
    }
}
