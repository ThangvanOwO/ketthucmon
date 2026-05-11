<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $categories = Category::select('id', 'name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_url' => 'nullable|string|max:2048',
            'gallery_images' => 'nullable|array|max:10',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imageUrl = $request->input('image_url');

        // Handle main image upload
        if ($request->hasFile('image')) {
            $imageUrl = $request->file('image')->store('products', 'public');
            $imageUrl = '/storage/' . $imageUrl;
        }

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => $imageUrl,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'view' => 0,
        ]);

        // Handle gallery images upload via spatie/laravel-medialibrary
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $file) {
                $product->addMedia($file)
                    ->withCustomProperties(['sort_order' => $index])
                    ->toMediaCollection('gallery');
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $product->load('media');
        $categories = Category::select('id', 'name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_url' => 'nullable|string|max:2048',
            'gallery_images' => 'nullable|array|max:10',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imageUrl = $request->input('image_url', $product->image);

        // Handle main image upload
        if ($request->hasFile('image')) {
            $imageUrl = $request->file('image')->store('products', 'public');
            $imageUrl = '/storage/' . $imageUrl;
        }

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => $imageUrl,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        // Handle new gallery images upload
        if ($request->hasFile('gallery_images')) {
            $existingCount = $product->getMedia('gallery')->count();
            foreach ($request->file('gallery_images') as $index => $file) {
                $product->addMedia($file)
                    ->withCustomProperties(['sort_order' => $existingCount + $index])
                    ->toMediaCollection('gallery');
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->clearMediaCollection('gallery');
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công!');
    }

    /**
     * Delete a specific gallery image
     */
    public function deleteGalleryImage(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $mediaId = $request->input('media_id');

        $media = $product->getMedia('gallery')->firstWhere('id', $mediaId);
        if ($media) {
            $media->delete();
            return back()->with('success', 'Đã xóa ảnh!');
        }

        return back()->with('error', 'Không tìm thấy ảnh!');
    }
}
