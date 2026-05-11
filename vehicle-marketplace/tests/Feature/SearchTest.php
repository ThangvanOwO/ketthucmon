<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $cat = Category::create(['name' => 'Xe hơi']);
        Product::create([
            'name' => 'Honda Civic', 'slug' => 'honda-civic',
            'description' => 'Sedan hạng C', 'price' => 700000000, 'quantity' => 3, 'category_id' => $cat->id,
        ]);
        Product::create([
            'name' => 'Toyota Camry', 'slug' => 'toyota-camry',
            'description' => 'Sedan hạng D', 'price' => 1200000000, 'quantity' => 2, 'category_id' => $cat->id,
        ]);
    }

    public function test_tim_kiem_theo_ten_san_pham(): void
    {
        $response = $this->get(route('search', ['q' => 'Honda']));
        $response->assertStatus(200);
        $response->assertSee('Honda Civic');
        $response->assertDontSee('Toyota Camry');
    }

    public function test_tim_kiem_theo_mo_ta(): void
    {
        $response = $this->get(route('search', ['q' => 'hạng D']));
        $response->assertStatus(200);
        $response->assertSee('Toyota Camry');
    }

    public function test_tim_kiem_khong_co_ket_qua(): void
    {
        $response = $this->get(route('search', ['q' => 'Ferrari']));
        $response->assertStatus(200);
        $response->assertSee('Không tìm thấy');
    }
}
