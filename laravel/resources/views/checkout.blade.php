@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

    <h1 class="text-3xl font-bold mb-6">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- CHECKOUT FORM --}}
        <div class="lg:col-span-2">
            <form method="POST" action="{{ route('order.place') }}">
                @csrf
                <div class="bg-white rounded-xl shadow p-6 space-y-4">
                    <h2 class="text-xl font-bold mb-4">Informacije o dostavi</h2>

                    <div>
                        <label class="block text-gray-600 mb-1">Puno ime</label>
                        <input type="text" name="full_name" value="{{ auth()->user()->name }}"
                               class="w-full border rounded-lg px-4 py-2" required>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Adresa</label>
                        <input type="text" name="address"
                               class="w-full border rounded-lg px-4 py-2" required>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Grad</label>
                        <input type="text" name="city"
                               class="w-full border rounded-lg px-4 py-2" required>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Telefon</label>
                        <input type="text" name="phone"
                               class="w-full border rounded-lg px-4 py-2" required>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Napomena (opciono)</label>
                        <textarea name="note" rows="3"
                                  class="w-full border rounded-lg px-4 py-2"
                                  placeholder="Any special delivery instructions..."></textarea>
                    </div>
                </div>

                {{-- SUBMIT --}}
                <button type="submit"
                        class="w-full bg-blue-600 text-white px-6 py-4 rounded-xl mt-4 hover:bg-blue-700 font-semibold text-lg">
                    Nastavi sa plaćanjem — RSD {{ number_format($total, 2) }}
                </button>
            </form>
        </div>

        {{-- ORDER SUMMARY --}}
        <div class="bg-white rounded-xl shadow p-6 h-fit">
            <h2 class="text-xl font-bold mb-4">Vaša porudžba</h2>
            @foreach($cartItems as $item)
                <div class="flex justify-between py-2 border-b text-sm">
                    <span class="text-gray-700">{{ $item->product->name }} x{{ $item->quantity }}</span>
                    <span class="font-semibold">RSD {{ number_format($item->product->price * $item->quantity, 2) }}</span>
                </div>
            @endforeach
            <div class="flex justify-between font-bold text-lg mt-4">
                <span>Ukupno</span>
                <span class="text-blue-600">RSD {{ number_format($total, 2) }}</span>
            </div>
        </div>

    </div>

@endsection