@extends('layouts.app')

@section('title', 'Catalog')

@section('content')

    <h1 class="text-3xl font-bold mb-6">Catalog</h1>

    {{-- FILTERS --}}
    <form method="GET" action="{{ route('catalog') }}" class="bg-white rounded-xl shadow p-4 mb-6 flex gap-4 flex-wrap">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search products..."
            class="border rounded-lg px-4 py-2 flex-1 min-w-48"
        >

        <select name="category" class="border rounded-lg px-4 py-2">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
            Filter
        </button>

        @if(request('search') || request('category'))
            <a href="{{ route('catalog') }}" class="text-gray-500 px-4 py-2 hover:text-red-500">
                Clear
            </a>
        @endif
    </form>

    {{-- PRODUCTS GRID --}}
    @if($products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
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
                        <p class="text-xs text-blue-500 mb-1">{{ $product->category->name }}</p>
                        <p class="font-semibold text-gray-800">{{ $product->name }}</p>
                        <p class="text-blue-600 font-bold mt-1">${{ number_format($product->price, 2) }}</p>
                        @if($product->stock > 0)
                            <p class="text-green-500 text-xs mt-1">In stock</p>
                        @else
                            <p class="text-red-500 text-xs mt-1">Out of stock</p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="mt-8">
            {{ $products->withQueryString()->links() }}
        </div>

    @else
        <div class="text-center text-gray-400 py-20">
            <p class="text-xl">No products found.</p>
            <a href="{{ route('catalog') }}" class="text-blue-500 mt-2 inline-block">Clear filters</a>
        </div>
    @endif

@endsection

@php use Illuminate\Support\Facades\Storage; @endphp