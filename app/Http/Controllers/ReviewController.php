<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $exists = Review::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'You already reviewed this service.');
        }

        Review::create([
            'user_id'    => auth()->id(),
            'product_id' => $product->id,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Review submitted. Thank you!');
    }

    public function destroy(Review $review)
    {
        if (auth()->id() !== $review->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }
        $review->delete();
        return redirect()->back()->with('success', 'Review deleted.');
    }
}
