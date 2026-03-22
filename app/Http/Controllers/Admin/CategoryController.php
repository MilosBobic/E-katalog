<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store()
    {
        Category::create([
            'name'        => request('name'),
            'slug'        => Str::slug(request('name')),
            'description' => request('description'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update($id)
    {
        $category = Category::findOrFail($id);

        $category->update([
            'name'        => request('name'),
            'slug'        => Str::slug(request('name')),
            'description' => request('description'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated!');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted!');
    }
}