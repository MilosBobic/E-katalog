@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    {{-- STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500 text-sm">Total Orders</p>
            <p class="text-4xl font-bold text-gray-800 mt-1">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500 text-sm">Total Revenue</p>
            <p class="text-4xl font-bold text-blue-600 mt-1">${{ number_format($totalRevenue, 2) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500 text-sm">Pending Orders</p>
            <p class="text-4xl font-bold text-yellow-500 mt-1">{{ $pendingOrders }}</p>
        </div>
    </div>

    {{-- RECENT ORDERS --}}
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold mb-4">Recent Orders</h2>
        @if($recentOrders->count() > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 border-b">
                        <th class="pb-3">Order</th>
                        <th class="pb-3">Customer</th>
                        <th class="pb-3">Total</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3">Date</th>
                        <th class="pb-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($recentOrders as $order)
                        <tr>
                            <td class="py-3 font-semibold">#{{ $order->id }}</td>
                            <td class="py-3">{{ $order->user->name }}</td>
                            <td class="py-3 text-blue-600 font-semibold">${{ number_format($order->total, 2) }}</td>
                            <td class="py-3">
                                <span @class([
                                    'px-2 py-1 rounded-full text-xs font-semibold',
                                    'bg-yellow-100 text-yellow-700' => $order->status === 'pending',
                                    'bg-blue-100 text-blue-700' => $order->status === 'processing',
                                    'bg-green-100 text-green-700' => $order->status === 'delivered',
                                ])>{{ ucfirst($order->status) }}</span>
                            </td>
                            <td class="py-3 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="py-3">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-500 hover:underline">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-400">No orders yet.</p>
        @endif
    </div>

@endsection