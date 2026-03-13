@extends('layouts.app')

@section('title', 'Order #' . $order->id)

@section('content')

    <div class="mb-4">
        <a href="{{ route('orders.index') }}" class="text-blue-500 hover:underline">← Back to Orders</a>
    </div>

    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold">Order #{{ $order->id }}</h1>
                <p class="text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
            <span @class([
                'px-4 py-2 rounded-full font-semibold',
                'bg-yellow-100 text-yellow-700' => $order->status === 'pending',
                'bg-blue-100 text-blue-700' => $order->status === 'processing',
                'bg-green-100 text-green-700' => $order->status === 'delivered',
            ])>
                {{ ucfirst($order->status) }}
            </span>
        </div>

        {{-- DELIVERY INFO --}}
        <div class="grid grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded-xl">
            <div>
                <p class="text-gray-500 text-sm">Puno ime</p>
                <p class="font-semibold">{{ $order->full_name }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Telefon</p>
                <p class="font-semibold">{{ $order->phone }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Adresa</p>
                <p class="font-semibold">{{ $order->address }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Grad</p>
                <p class="font-semibold">{{ $order->city }}</p>
            </div>
            @if($order->note)
                <div class="col-span-2">
                    <p class="text-gray-500 text-sm">Napomena</p>
                    <p class="font-semibold">{{ $order->note }}</p>
                </div>
            @endif
        </div>

        {{-- ORDER ITEMS --}}
        <h2 class="text-xl font-bold mb-4">Items</h2>
        <div class="space-y-3">
            @foreach($order->items as $item)
                <div class="flex justify-between items-center py-3 border-b">
                    <div>
                        <p class="font-semibold">{{ $item->product->name }}</p>
                        <p class="text-gray-500 text-sm">x{{ $item->quantity }} × ${{ number_format($item->price, 2) }}</p>
                    </div>
                    <p class="font-bold text-blue-600">
                        ${{ number_format($item->price * $item->quantity, 2) }}
                    </p>
                </div>
            @endforeach
        </div>

        {{-- TOTAL --}}
        <div class="flex justify-between font-bold text-xl mt-6 pt-4 border-t">
            <span>Total</span>
            <span class="text-blue-600">RSD {{ number_format($order->total, 2) }}</span>
        </div>
    </div>

@endsection