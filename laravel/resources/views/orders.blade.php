@extends('layouts.app')

@section('title', 'My Orders')

@section('content')

    <h1 class="text-3xl font-bold mb-6">My Orders</h1>

    @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
                <a href="{{ route('orders.show', $order->id) }}"
                   class="bg-white rounded-xl shadow p-6 flex justify-between items-center hover:shadow-md transition block">
                    <div>
                        <p class="font-bold text-gray-800">Porudžba #{{ $order->id }}</p>
                        <p class="text-gray-500 text-sm">{{ $order->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="text-center">
                        <span @class([
                            'px-3 py-1 rounded-full text-sm font-semibold',
                            'bg-yellow-100 text-yellow-700' => $order->status === 'pending',
                            'bg-blue-100 text-blue-700' => $order->status === 'processing',
                            'bg-green-100 text-green-700' => $order->status === 'delivered',
                        ])>
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-blue-600">RSD {{ number_format($order->total, 2) }}</p>
                        <p class="text-gray-400 text-sm">Pogledaj detalje →</p>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-20 text-gray-400">
            <p class="text-5xl mb-4">📦</p>
            <p class="text-xl mb-4">Nemate porudžbina</p>
            <a href="{{ route('catalog') }}" class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700">
                Počni sa kupovinom
            </a>
        </div>
    @endif

@endsection