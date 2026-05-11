<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function createProduct(array $attrs = []): Product
    {
        $category = Category::firstOrCreate(['name' => 'Xe hơi']);
        return Product::create(array_merge([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'Mô tả test',
            'price' => 500000000,
            'quantity' => 5,
            'view' => 0,
            'category_id' => $category->id,
        ], $attrs));
    }

    public function test_xem_chi_tiet_san_pham_theo_slug(): void
    {
        $product = $this->createProduct(['name' => 'Kinetic GT-R', 'slug' => 'kinetic-gt-r']);

        $response = $this->get(route('product.show', $product->slug));
        $response->assertStatus(200);
        $response->assertViewIs('product.show');
        $response->assertSee('Kinetic GT-R');
    }

    public function test_san_pham_khong_ton_tai_tra_ve_404(): void
    {
        $response = $this->get('/product/khong-ton-tai');
        $response->assertStatus(404);
    }

    public function test_view_count_tang_khi_xem_san_pham(): void
    {
        $product = $this->createProduct(['view' => 10]);

        $this->get(route('product.show', $product->slug));
        $this->assertEquals(11, $product->fresh()->view);

        $this->get(route('product.show', $product->slug));
        $this->assertEquals(12, $product->fresh()->view);
    }

    public function test_hien_thi_san_pham_lien_quan_cung_danh_muc(): void
    {
        $cat = Category::create(['name' => 'Xe máy']);
        $main = Product::create([
            'name' => 'Main Bike', 'slug' => 'main-bike', 'price' => 100, 'quantity' => 1, 'category_id' => $cat->id,
        ]);
        Product::create([
            'name' => 'Related Bike', 'slug' => 'related-bike', 'price' => 200, 'quantity' => 1, 'category_id' => $cat->id,
        ]);

        $response = $this->get(route('product.show', $main->slug));
        $response->assertStatus(200);
        $response->assertSee('Related Bike');
    }

    public function test_slug_phai_duy_nhat(): void
    {
        $this->createProduct(['slug' => 'duplicate-slug']);

        $this->expectException(\Illuminate\Database\QueryException::class);
        $this->createProduct(['name' => 'Another', 'slug' => 'duplicate-slug']);
    }
}
