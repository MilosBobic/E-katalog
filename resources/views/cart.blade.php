@extends('layouts.app')

@section('title', 'Cart')

@section('content')

    <h1 class="text-3xl font-bold mb-6">Your Cart</h1>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- CART ITEMS --}}
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                    <div class="bg-white rounded-xl shadow p-4 flex gap-4 items-center">

                        {{-- IMAGE --}}
                        @if($item->product->image)
                            <img src="{{ Storage::url($item->product->image) }}"
                                 class="w-20 h-20 object-cover rounded-lg" alt="{{ $item->product->name }}">
                        @else
                            <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs">
                                No image
                            </div>
                        @endif

                        {{-- DETAILS --}}
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">{{ $item->product->name }}</p>
                            <p class="text-blue-600 font-bold">RSD {{ number_format($item->product->price, 2) }}</p>
                        </div>

                        {{-- QUANTITY --}}
                        <form method="POST" action="{{ route('cart.update', $item->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-center gap-2">
                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                       min="1" max="{{ $item->product->stock }}"
                                       class="border rounded-lg px-3 py-2 w-20">
                                <button type="submit" class="text-blue-500 hover:text-blue-700 text-sm">
                                    Update
                                </button>
                            </div>
                        </form>

                        {{-- SUBTOTAL --}}
                        <p class="font-bold text-gray-700 w-24 text-right">
                            ${{ number_format($item->product->price * $item->quantity, 2) }}
                        </p>

                        {{-- REMOVE --}}
                        <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-600">
                                ✕
                            </button>
                        </form>

                    </div>
                @endforeach
            </div>

            {{-- ORDER SUMMARY --}}
            <div class="bg-white rounded-xl shadow p-6 h-fit">
                <h2 class="text-xl font-bold mb-4">Porudžba</h2>
                <div class="flex justify-between mb-2 text-gray-600">
                    <span>Ukupna cena</span>
                    <span>RSD {{ number_format($total, 2) }}</span>
                </div>
                <div class="flex justify-between mb-4 text-gray-600">
                    <span>Dostava</span>
                    <span class="text-green-500">Free</span>
                </div>
                <div class="border-t pt-4 flex justify-between font-bold text-lg">
                    <span>Cena</span>
                    <span class="text-blue-600">RSD {{ number_format($total, 2) }}</span>
                </div>
                <a href="{{ route('checkout') }}"
                   class="block text-center bg-blue-600 text-white px-6 py-3 rounded-xl mt-6 hover:bg-blue-700 font-semibold">
                    Nastavi na plaćanje
                </a>
                <a href="{{ route('catalog') }}"
                   class="block text-center text-gray-500 mt-3 hover:text-blue-500">
                    Nastavi sa kupovinom
                </a>
            </div>

        </div>
    @else
        <div class="text-center py-20 text-gray-400">
            <p class="text-5xl mb-4">🛒</p>
            <p class="text-xl mb-4">Vaša korpa je prazna</p>
            <a href="{{ route('catalog') }}" class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700">
                Pregledaj katalog
            </a>
        </div>
    @endif

@endsection

@php use Illuminate\Support\Facades\Storage; @endphp