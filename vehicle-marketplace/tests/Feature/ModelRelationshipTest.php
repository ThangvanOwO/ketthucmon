<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ModelRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_co_nhieu_products(): void
    {
        $cat = Category::create(['name' => 'Xe hơi']);
        Product::create(['name' => 'A', 'slug' => 'a', 'price' => 1, 'quantity' => 1, 'category_id' => $cat->id]);
        Product::create(['name' => 'B', 'slug' => 'b', 'price' => 2, 'quantity' => 1, 'category_id' => $cat->id]);

        $this->assertCount(2, $cat->products);
    }

    public function test_product_thuoc_ve_mot_category(): void
    {
        $cat = Category::create(['name' => 'Xe máy']);
        $p = Product::create(['name' => 'P', 'slug' => 'p', 'price' => 1, 'quantity' => 1, 'category_id' => $cat->id]);

        $this->assertEquals('Xe máy', $p->category->name);
    }

    public function test_user_co_nhieu_orders(): void
    {
        $user = User::create(['email' => 'a@b.c', 'password' => Hash::make('x'), 'role' => 'user']);
        Order::create(['code' => 'O1', 'status' => 'pending', 'user_id' => $user->id, 'customer_name' => 'A', 'phone' => '0123', 'email' => 'a@b.c', 'address' => 'Addr', 'payment_method' => 'cod']);
        Order::create(['code' => 'O2', 'status' => 'done', 'user_id' => $user->id, 'customer_name' => 'A', 'phone' => '0123', 'email' => 'a@b.c', 'address' => 'Addr', 'payment_method' => 'cod']);

        $this->assertCount(2, $user->orders);
    }

    public function test_order_co_nhieu_order_details(): void
    {
        $user = User::create(['email' => 'a@b.c', 'password' => Hash::make('x'), 'role' => 'user']);
        $cat = Category::create(['name' => 'Xe hơi']);
        $p1 = Product::create(['name' => 'P1', 'slug' => 'p1', 'price' => 100, 'quantity' => 5, 'category_id' => $cat->id]);
        $p2 = Product::create(['name' => 'P2', 'slug' => 'p2', 'price' => 200, 'quantity' => 5, 'category_id' => $cat->id]);
        $order = Order::create(['code' => 'O1', 'status' => 'pending', 'user_id' => $user->id, 'customer_name' => 'A', 'phone' => '0123', 'email' => 'a@b.c', 'address' => 'Addr', 'payment_method' => 'cod']);

        OrderDetail::create(['order_id' => $order->id, 'product_id' => $p1->id, 'quantity' => 1, 'price' => 100]);
        OrderDetail::create(['order_id' => $order->id, 'product_id' => $p2->id, 'quantity' => 2, 'price' => 200]);

        $this->assertCount(2, $order->orderDetails);
        $this->assertEquals('P1', $order->orderDetails->first()->product->name);
    }

    public function test_product_slug_duoc_dung_cho_route_key(): void
    {
        $cat = Category::create(['name' => 'Xe hơi']);
        $p = Product::create(['name' => 'X', 'slug' => 'my-slug', 'price' => 1, 'quantity' => 1, 'category_id' => $cat->id]);

        $this->assertEquals('slug', $p->getRouteKeyName());
        $this->assertEquals('my-slug', $p->getRouteKey());
    }
}
