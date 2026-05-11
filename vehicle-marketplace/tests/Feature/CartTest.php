<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $cat = Category::create(['name' => 'Xe hơi']);
        $this->product = Product::create([
            'name' => 'Test Car', 'slug' => 'test-car', 'description' => 'X',
            'price' => 1000000, 'quantity' => 10, 'category_id' => $cat->id,
        ]);
    }

    public function test_gio_hang_rong_luc_dau(): void
    {
        $response = $this->get(route('cart.index'));
        $response->assertStatus(200);
        $this->assertEmpty(session('cart', []));
    }

    public function test_them_san_pham_vao_gio_hang(): void
    {
        $response = $this->post(route('cart.add', $this->product->id), [
            'quantity' => 2,
        ]);

        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('success');

        $cart = session('cart');
        $this->assertArrayHasKey($this->product->id, $cart);
        $this->assertEquals(2, $cart[$this->product->id]['quantity']);
        $this->assertEquals('Test Car', $cart[$this->product->id]['name']);
    }

    public function test_them_san_pham_da_co_cong_don_so_luong(): void
    {
        $this->post(route('cart.add', $this->product->id), ['quantity' => 2]);
        $this->post(route('cart.add', $this->product->id), ['quantity' => 3]);

        $cart = session('cart');
        $this->assertEquals(5, $cart[$this->product->id]['quantity']);
    }

    public function test_cap_nhat_so_luong_trong_gio_hang(): void
    {
        $this->post(route('cart.add', $this->product->id), ['quantity' => 1]);

        $response = $this->patch(route('cart.update', $this->product->id), [
            'quantity' => 7,
        ]);

        $response->assertRedirect(route('cart.index'));
        $cart = session('cart');
        $this->assertEquals(7, $cart[$this->product->id]['quantity']);
    }

    public function test_xoa_san_pham_khoi_gio_hang(): void
    {
        $this->post(route('cart.add', $this->product->id), ['quantity' => 1]);

        $response = $this->delete(route('cart.remove', $this->product->id));

        $response->assertRedirect(route('cart.index'));
        $cart = session('cart', []);
        $this->assertArrayNotHasKey($this->product->id, $cart);
    }

    public function test_them_san_pham_khong_ton_tai_tra_ve_404(): void
    {
        $response = $this->post(route('cart.add', 9999), ['quantity' => 1]);
        $response->assertStatus(404);
    }
}
