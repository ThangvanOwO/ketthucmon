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

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Order $order;
    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $cat = Category::create(['name' => 'Xe hơi']);
        $this->product = Product::create([
            'name' => 'Test Car', 'slug' => 'test-car',
            'price' => 500000, 'quantity' => 5, 'category_id' => $cat->id,
        ]);
        $this->user = User::create([
            'email' => 'order@test.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        $this->order = Order::create([
            'code' => 'ORD-TEST1234',
            'status' => 'pending',
            'user_id' => $this->user->id,
            'customer_name' => 'Test User',
            'phone' => '0912345678',
            'email' => 'order@test.com',
            'address' => '123 Test Street',
            'payment_method' => 'cod',
        ]);
        OrderDetail::create([
            'product_id' => $this->product->id,
            'order_id' => $this->order->id,
            'quantity' => 2,
            'price' => $this->product->price,
        ]);
    }

    public function test_chua_dang_nhap_redirect_ve_login(): void
    {
        $response = $this->get(route('order.index'));
        $response->assertRedirect(route('auth'));
    }

    public function test_hien_thi_danh_sach_don_hang(): void
    {
        $response = $this->actingAs($this->user)->get(route('order.index'));
        $response->assertStatus(200);
        $response->assertSee('ORD-TEST1234');
        $response->assertSee('Test Car');
    }

    public function test_xem_chi_tiet_don_hang(): void
    {
        $response = $this->actingAs($this->user)->get(route('order.show', $this->order->id));
        $response->assertStatus(200);
        $response->assertSee('ORD-TEST1234');
        $response->assertSee('Test Car');
        $response->assertSee('500.000');
    }

    public function test_khong_xem_duoc_don_hang_nguoi_khac(): void
    {
        $otherUser = User::create([
            'email' => 'other@test.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        $response = $this->actingAs($otherUser)->get(route('order.show', $this->order->id));
        $response->assertStatus(404);
    }

    public function test_don_hang_khong_ton_tai_tra_ve_404(): void
    {
        $response = $this->actingAs($this->user)->get(route('order.show', 9999));
        $response->assertStatus(404);
    }

    public function test_danh_sach_don_hang_chi_hien_thi_cua_minh(): void
    {
        $otherUser = User::create([
            'email' => 'other2@test.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        Order::create([
            'code' => 'ORD-OTHER000',
            'status' => 'pending',
            'user_id' => $otherUser->id,
            'customer_name' => 'Other User',
            'phone' => '0987654321',
            'email' => 'other2@test.com',
            'address' => '456 Other Street',
            'payment_method' => 'cod',
        ]);

        $response = $this->actingAs($this->user)->get(route('order.index'));
        $response->assertSee('ORD-TEST1234');
        $response->assertDontSee('ORD-OTHER000');
    }
}
