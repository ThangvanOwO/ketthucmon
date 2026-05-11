<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name')->get();
        $latestProducts = Product::with('category:id,name')->select('id', 'name', 'slug', 'image', 'price', 'category_id')->latest()->take(8)->get();

        return view('home', compact('categories', 'latestProducts'));
    }
}
