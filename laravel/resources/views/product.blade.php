@extends('layouts.app')

@section('title', $product->name)

@section('content')

    <div class="bg-white rounded-xl shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- IMAGE --}}
            <div>
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}"
                         class="w-full rounded-xl object-cover" alt="{{ $product->name }}">
                @else
                    <div class="w-full h-80 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400">
                        Nema slike
                    </div>
                @endif
            </div>

            {{-- DETAILS --}}
            <div>
                <p class="text-sm text-blue-500 mb-2">{{ $product->category->name }}</p>
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
                <p class="text-gray-600 mb-6">{{ $product->description }}</p>
                <p class="text-3xl font-bold text-blue-600 mb-4">RSD {{ number_format($product->price, 2) }}</p>

                @if($product->stock > 0)
                    <p class="text-green-500 mb-6">✅ Na stanju ({{ $product->stock }} dostupno)</p>

                    @auth
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="flex items-center gap-4 mb-4">
                                <label class="text-gray-600">Količina:</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                       class="border rounded-lg px-3 py-2 w-20">
                            </div>
                            <button type="submit"
                                    class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 font-semibold">
                                🛒 Dodaj u korpu
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 font-semibold inline-block">
                            Prijavite se da kupite
                        </a>
                    @endauth
                @else
                    <p class="text-red-500 text-lg">❌ Nema na stanju</p>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('catalog') }}" class="text-blue-500 hover:underline">← Nazad u katalog</a>
    </div>

@endsection

@php use Illuminate\Support\Facades\Storage; @endphp