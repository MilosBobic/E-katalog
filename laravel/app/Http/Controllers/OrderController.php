<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->with('items.product')
            ->firstOrFail();

        return view('order-detail', compact('order'));
    }

    public function checkout()
    {
        $cartItems = CartItem::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('checkout', compact('cartItems', 'total'));
    }

    public function placeOrder()
    {
        $cartItems = CartItem::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id'   => auth()->id(),
            'status'    => 'pending',
            'total'     => $total,
            'full_name' => request('full_name'),
            'address'   => request('address'),
            'city'      => request('city'),
            'phone'     => request('phone'),
            'note'      => request('note'),
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        // Clear the cart
        CartItem::where('user_id', auth()->id())->delete();

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }
}