<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store()
    {
        $imagePath = null;

        if (request()->hasFile('image')) {
            $imagePath = request()->file('image')->store('products', 'public');
        }

        Product::create([
            'category_id' => request('category_id'),
            'name'        => request('name'),
            'slug'        => Str::slug(request('name')),
            'description' => request('description'),
            'price'       => request('price'),
            'stock'       => request('stock'),
            'image'       => $imagePath,
            'is_featured' => request()->boolean('is_featured'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update($id)
    {
        $product = Product::findOrFail($id);
        $imagePath = $product->image;

        if (request()->hasFile('image')) {
            $imagePath = request()->file('image')->store('products', 'public');
        }

        $product->update([
            'category_id' => request('category_id'),
            'name'        => request('name'),
            'slug'        => Str::slug(request('name')),
            'description' => request('description'),
            'price'       => request('price'),
            'stock'       => request('stock'),
            'image'       => $imagePath,
            'is_featured' => request()->boolean('is_featured'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted!');
    }
}