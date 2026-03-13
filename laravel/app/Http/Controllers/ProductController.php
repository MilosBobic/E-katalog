<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $products = Product::query()
            ->when(request('category'), function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', request('category'));
                });
            })
            ->when(request('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            })
            ->paginate(12);

        return view('catalog', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('product', compact('product'));
    }
}