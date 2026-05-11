<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $allCategories = Category::select('id', 'name')->withCount('products')->get();
        $products = Product::with('category:id,name')->select('id', 'name', 'slug', 'image', 'price', 'quantity', 'view', 'category_id')->paginate(12);

        return view('category.index', compact('allCategories', 'products'));
    }

    public function show($id)
    {
        $currentCategory = Category::findOrFail($id);
        $allCategories = Category::select('id', 'name')->withCount('products')->get();
        $products = Product::with('category:id,name')
            ->select('id', 'name', 'slug', 'image', 'price', 'quantity', 'view', 'category_id')
            ->where('category_id', $id)
            ->paginate(12);

        return view('category.index', compact('allCategories', 'products', 'currentCategory'));
    }
}
