<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if (auth()->id() !== $order->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }
        $order->load('items.product.user');
        return view('orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $total = 0;
        $items = [];

        foreach ($cart as $productId => $item) {
            $product = Product::findOrFail($productId);
            $subtotal = $product->price * $item['quantity'];
            $total   += $subtotal;
            $items[]  = [
                'product_id' => $product->id,
                'quantity'   => $item['quantity'],
                'price'      => $product->price,
            ];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total'   => $total,
            'status'  => 'pending',
            'notes'   => $request->notes,
        ]);

        foreach ($items as $item) {
            $order->items()->create($item);
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully!');
    }

    public function cancel(Order $order)
    {
        if (auth()->id() !== $order->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending orders can be cancelled.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('orders.index')
            ->with('success', 'Order cancelled.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,validated,cancelled']);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Order status updated.');
    }
}
