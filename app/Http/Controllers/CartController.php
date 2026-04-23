<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function getCart(): array
    {
        return session('cart', []);
    }

    public function index()
    {
        $cart     = $this->getCart();
        $products = collect();
        $total    = 0;

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $products->push(['product' => $product, 'quantity' => $item['quantity']]);
                $total += $product->price * $item['quantity'];
            }
        }

        return view('cart.index', compact('products', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = $this->getCart();
        $qty  = $request->input('quantity', 1);

        $cart[$product->id] = [
            'quantity' => ($cart[$product->id]['quantity'] ?? 0) + $qty,
        ];

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Added to cart.');
    }

    public function update(Request $request, $productId)
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $qty = (int) $request->input('quantity', 1);
            if ($qty <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['quantity'] = $qty;
            }
            session(['cart' => $cart]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function remove($productId)
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Item removed.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index');
    }
}
