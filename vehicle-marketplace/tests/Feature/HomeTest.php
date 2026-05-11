<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_trang_chu_load_thanh_cong(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('home');
    }

    public function test_trang_chu_hien_thi_danh_muc_va_san_pham_moi(): void
    {
        $category = Category::create(['name' => 'Xe hơi']);
        $product = Product::create([
            'name' => 'Test Car',
            'slug' => 'test-car',
            'description' => 'Xe hơi test',
            'price' => 1000000,
            'quantity' => 5,
            'category_id' => $category->id,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Xe hơi');
        $response->assertSee('Test Car');
    }

    public function test_trang_about_load_thanh_cong(): void
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
        $response->assertViewIs('about');
    }
}
