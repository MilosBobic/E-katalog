<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function dashboard()
    {
        $totalOrders    = Order::count();
        $totalRevenue   = Order::where('status', 'delivered')->sum('total');
        $pendingOrders  = Order::where('status', 'pending')->count();
        $recentOrders   = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'recentOrders'
        ));
    }

    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product', 'user')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => request('status')]);

        return redirect()->back()->with('success', 'Order status updated!');
    }
}