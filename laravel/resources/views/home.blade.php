@php use Illuminate\Support\Facades\Storage; @endphp

@extends('layouts.app')

@section('title', 'Home')

@section('content')

    {{-- HERO --}}
    <div class="bg-blue-600 text-white rounded-2xl p-12 mb-10 text-center">
        <h1 class="text-4xl font-bold mb-4">Welcome to eKatalog</h1>
        <p class="text-lg mb-6 text-blue-100">Browse our catalog and order products with ease</p>
        <a href="{{ route('catalog') }}" class="bg-white text-blue-600 font-semibold px-8 py-3 rounded-full hover:bg-blue-50">
            Browse Catalog
        </a>
    </div>

    {{-- CATEGORIES --}}
    @if($categories->count() > 0)
        <h2 class="text-2xl font-bold mb-4">Categories</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            @foreach($categories as $category)
                <a href="{{ route('catalog', ['category' => $category->slug]) }}"
                   class="bg-white rounded-xl p-6 text-center shadow hover:shadow-md transition">
                    <p class="font-semibold text-gray-700">{{ $category->name }}</p>
                </a>
            @endforeach
        </div>
    @endif

    {{-- FEATURED PRODUCTS --}}
    @if($featuredProducts->count() > 0)
        <h2 class="text-2xl font-bold mb-4">Featured Products</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
                <a href="{{ route('product.show', $product->slug) }}"
                   class="bg-white rounded-xl shadow hover:shadow-md transition overflow-hidden">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}"
                             class="w-full h-48 object-cover" alt="{{ $product->name }}">
                    @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                            No image
                        </div>
                    @endif
                    <div class="p-4">
                        <p class="font-semibold text-gray-800">{{ $product->name }}</p>
                        <p class="text-blue-600 font-bold mt-1">${{ number_format($product->price, 2) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center text-gray-400 py-20">
            <p class="text-xl">No products yet. Check back soon!</p>
        </div>
    @endif

@endsection