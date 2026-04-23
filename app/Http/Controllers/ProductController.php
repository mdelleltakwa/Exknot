<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['user', 'category', 'reviews'])
            ->where('status', 'active');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            } else {
                $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products   = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('services.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load(['user', 'category', 'reviews.user']);
        return view('services.show', compact('product'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['user_id'] = auth()->id();
        Product::create($validated);

        return redirect()->route('firm.dashboard')
            ->with('success', 'Service published successfully.');
    }

    public function edit(Product $product)
    {
        if (auth()->id() !== $product->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }
        $categories = Category::all();
        return view('services.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        if (auth()->id() !== $product->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $product->update($validated);

        return redirect()->route('firm.dashboard')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Product $product)
    {
        if (auth()->id() !== $product->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()->route('firm.dashboard')
            ->with('success', 'Service deleted.');
    }
}
