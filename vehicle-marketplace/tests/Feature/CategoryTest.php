<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_trang_danh_sach_danh_muc(): void
    {
        Category::create(['name' => 'Xe hơi']);
        Category::create(['name' => 'Xe máy']);

        $response = $this->get(route('category.index'));
        $response->assertStatus(200);
        $response->assertViewIs('category.index');
        $response->assertSee('Xe hơi');
        $response->assertSee('Xe máy');
    }

    public function test_xem_san_pham_theo_danh_muc(): void
    {
        $xeHoi = Category::create(['name' => 'Xe hơi']);
        $xeMay = Category::create(['name' => 'Xe máy']);

        Product::create([
            'name' => 'Honda Civic',
            'slug' => 'honda-civic',
            'description' => 'Sedan',
            'price' => 700000000,
            'quantity' => 3,
            'category_id' => $xeHoi->id,
        ]);

        Product::create([
            'name' => 'Yamaha Exciter',
            'slug' => 'yamaha-exciter',
            'description' => 'Xe côn tay',
            'price' => 50000000,
            'quantity' => 10,
            'category_id' => $xeMay->id,
        ]);

        $response = $this->get(route('category.show', $xeHoi->id));
        $response->assertStatus(200);
        $response->assertSee('Honda Civic');
        $response->assertDontSee('Yamaha Exciter');
    }

    public function test_xem_danh_muc_khong_ton_tai_tra_ve_404(): void
    {
        $response = $this->get(route('category.show', 9999));
        $response->assertStatus(404);
    }
}
