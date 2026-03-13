@extends('layouts.admin')

@section('title', 'Order #' . $order->id)

@section('content')

    <a href="{{ route('admin.orders.index') }}" class="text-blue-500 hover:underline mb-4 inline-block">← Back</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ORDER ITEMS --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold">Order #{{ $order->id }}</h2>
                <span class="text-gray-400 text-sm">{{ $order->created_at->format('d M Y, H:i') }}</span>
            </div>

            <div class="space-y-3 mb-6">
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

            <div class="flex justify-between font-bold text-lg pt-4 border-t">
                <span>Total</span>
                <span class="text-blue-600">${{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        {{-- CUSTOMER + STATUS --}}
        <div class="space-y-4">

            {{-- CUSTOMER INFO --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-bold mb-4">Customer</h3>
                <p class="text-gray-700 font-semibold">{{ $order->user->name }}</p>
                <p class="text-gray-500 text-sm">{{ $order->user->email }}</p>
                <hr class="my-3">
                <p class="text-gray-700">{{ $order->full_name }}</p>
                <p class="text-gray-500 text-sm">{{ $order->address }}, {{ $order->city }}</p>
                <p class="text-gray-500 text-sm">{{ $order->phone }}</p>
                @if($order->note)
                    <p class="text-gray-400 text-sm mt-2 italic">{{ $order->note }}</p>
                @endif
            </div>

            {{-- UPDATE STATUS --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-bold mb-4">Update Status</h3>
                <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="w-full border rounded-lg px-4 py-2 mb-3">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                    </select>
                    <button type="submit"
                            class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Update Status
                    </button>
                </form>
            </div>

        </div>
    </div>

@endsection