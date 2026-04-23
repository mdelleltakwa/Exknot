<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function client()
    {
        $orders   = auth()->user()->orders()->with('items.product')->latest()->take(5)->get();
        $reviews  = auth()->user()->reviews()->with('product')->latest()->take(5)->get();
        $cartCount = count(session('cart', []));

        return view('dashboard.client', compact('orders', 'reviews', 'cartCount'));
    }

    public function firm()
    {
        $user     = auth()->user();
        $services = $user->products()->with('category', 'reviews')->latest()->get();
        $orderItems = \App\Models\OrderItem::whereIn('product_id', $services->pluck('id'))
            ->with('order.user', 'product')
            ->latest()
            ->take(10)
            ->get();

        $revenue = $orderItems->where('order.status', 'validated')->sum(fn($i) => $i->price * $i->quantity);

        return view('dashboard.firm', compact('services', 'orderItems', 'revenue'));
    }

    public function admin()
    {
        $stats = [
            'users'    => User::count(),
            'firms'    => User::where('role', 'firm')->count(),
            'clients'  => User::where('role', 'client')->count(),
            'products' => Product::count(),
            'orders'   => Order::count(),
            'pending'  => Order::where('status', 'pending')->count(),
        ];

        $users  = User::latest()->paginate(20);
        $orders = Order::with('user')->latest()->take(10)->get();

        return view('dashboard.admin', compact('stats', 'users', 'orders'));
    }
}
