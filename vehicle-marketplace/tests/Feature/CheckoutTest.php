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

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    protected Product $product;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $cat = Category::create(['name' => 'Xe hơi']);
        $this->product = Product::create([
            'name' => 'Test Car', 'slug' => 'test-car',
            'price' => 1000000, 'quantity' => 10, 'category_id' => $cat->id,
        ]);
        $this->user = User::create([
            'email' => 'buyer@test.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }

    protected function checkoutData(): array
    {
        return [
            'customer_name' => 'Nguyễn Văn A',
            'phone' => '0912345678',
            'email' => 'buyer@test.com',
            'address' => '123 Đường Lê Lợi, Quận 1, TP.HCM',
            'payment_method' => 'cod',
        ];
    }

    public function test_checkout_gio_hang_rong_redirect_ve_cart(): void
    {
        $response = $this->get(route('checkout'));
        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('error');
    }

    public function test_hien_thi_trang_checkout_khi_co_gio_hang(): void
    {
        $response = $this->withSession(['cart' => [
            $this->product->id => [
                'name' => $this->product->name,
                'quantity' => 2,
                'price' => $this->product->price,
                'image' => '',
            ],
        ]])->get(route('checkout'));

        $response->assertStatus(200);
        $response->assertViewIs('checkout');
    }

    public function test_chua_dang_nhap_khong_the_dat_hang(): void
    {
        $response = $this->withSession(['cart' => [
            $this->product->id => ['name' => 'X', 'quantity' => 1, 'price' => 100, 'image' => '',
        ]]])->post(route('checkout.process'), $this->checkoutData());

        $response->assertRedirect(route('auth'));
    }

    public function test_dat_hang_thanh_cong_tao_order_va_order_details(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['cart' => [
                $this->product->id => [
                    'name' => $this->product->name,
                    'quantity' => 3,
                    'price' => $this->product->price,
                    'image' => '',
                ],
            ]])
            ->post(route('checkout.process'), $this->checkoutData());

        $order = Order::first();
        $response->assertRedirect(route('order.show', $order->id));
        $response->assertSessionHas('success');

        $this->assertDatabaseCount('orders', 1);
        $this->assertDatabaseCount('order_details', 1);

        $order = Order::first();
        $this->assertEquals($this->user->id, $order->user_id);
        $this->assertEquals('pending', $order->status);
        $this->assertStringStartsWith('ORD-', $order->code);
        $this->assertEquals('Nguyễn Văn A', $order->customer_name);
        $this->assertEquals('0912345678', $order->phone);
        $this->assertEquals('buyer@test.com', $order->email);
        $this->assertEquals('123 Đường Lê Lợi, Quận 1, TP.HCM', $order->address);
        $this->assertEquals('cod', $order->payment_method);

        $detail = OrderDetail::first();
        $this->assertEquals($this->product->id, $detail->product_id);
        $this->assertEquals(3, $detail->quantity);
        $this->assertEquals($this->product->price, $detail->price);
    }

    public function test_dat_hang_xong_gio_hang_duoc_xoa(): void
    {
        $this->actingAs($this->user)
            ->withSession(['cart' => [
                $this->product->id => ['name' => 'X', 'quantity' => 1, 'price' => 100, 'image' => '',
            ]]])
            ->post(route('checkout.process'), $this->checkoutData());

        $this->assertEmpty(session('cart', []));
    }

    public function test_dat_hang_gio_rong_redirect_ve_cart(): void
    {
        $response = $this->actingAs($this->user)->post(route('checkout.process'), $this->checkoutData());
        $response->assertRedirect(route('cart.index'));
    }

    public function test_validate_thieu_thong_tin_ca_nhan(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['cart' => [
                $this->product->id => ['name' => 'X', 'quantity' => 1, 'price' => 100, 'image' => '',
            ]]])
            ->post(route('checkout.process'), [
                'payment_method' => 'cod',
            ]);

        $response->assertSessionHasErrors(['customer_name', 'phone', 'email', 'address']);
    }

    public function test_validate_phuong_thuc_thanh_toan_khong_hop_le(): void
    {
        $data = $this->checkoutData();
        $data['payment_method'] = 'invalid';

        $response = $this->actingAs($this->user)
            ->withSession(['cart' => [
                $this->product->id => ['name' => 'X', 'quantity' => 1, 'price' => 100, 'image' => '',
            ]]])
            ->post(route('checkout.process'), $data);

        $response->assertSessionHasErrors('payment_method');
    }

    public function test_dat_hang_voi_phuong_thuc_chuyen_khoan(): void
    {
        $data = $this->checkoutData();
        $data['payment_method'] = 'bank_transfer';

        $response = $this->actingAs($this->user)
            ->withSession(['cart' => [
                $this->product->id => ['name' => 'X', 'quantity' => 1, 'price' => 100, 'image' => '',
            ]]])
            ->post(route('checkout.process'), $data);

        $order = Order::first();
        $this->assertEquals('bank_transfer', $order->payment_method);
    }
}
