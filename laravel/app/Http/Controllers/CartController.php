<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', auth()->id())
            ->with('product')
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart', compact('cartItems', 'total'));
    }

    public function add()
    {
        $existing = CartItem::where('user_id', auth()->id())
            ->where('product_id', request('product_id'))
            ->first();

        if ($existing) {
            $existing->increment('quantity', request('quantity', 1));
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => request('product_id'),
                'quantity' => request('quantity', 1),
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update($id)
    {
        $item = CartItem::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $item->update(['quantity' => request('quantity')]);

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        CartItem::where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        return redirect()->back()->with('success', 'Item removed!');
    }
}