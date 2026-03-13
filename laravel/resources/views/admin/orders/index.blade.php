@extends('layouts.admin')

@section('title', 'Orders')

@section('content')

    <h2 class="text-2xl font-bold mb-6">All Orders</h2>

    <div class="bg-white rounded-xl shadow">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b">
                    <th class="p-4">Order</th>
                    <th class="p-4">Customer</th>
                    <th class="p-4">City</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Date</th>
                    <th class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($orders as $order)
                    <tr>
                        <td class="p-4 font-semibold">#{{ $order->id }}</td>
                        <td class="p-4">{{ $order->user->name }}</td>
                        <td class="p-4 text-gray-500">{{ $order->city }}</td>
                        <td class="p-4 text-blue-600 font-semibold">${{ number_format($order->total, 2) }}</td>
                        <td class="p-4">
                            <span @class([
                                'px-2 py-1 rounded-full text-xs font-semibold',
                                'bg-yellow-100 text-yellow-700' => $order->status === 'pending',
                                'bg-blue-100 text-blue-700' => $order->status === 'processing',
                                'bg-green-100 text-green-700' => $order->status === 'delivered',
                            ])>{{ ucfirst($order->status) }}</span>
                        </td>
                        <td class="p-4 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="p-4">
                            <a href="{{ route('admin.orders.show', $order->id) }}"
                               class="text-blue-500 hover:underline">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-4 text-center text-gray-400">No orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection