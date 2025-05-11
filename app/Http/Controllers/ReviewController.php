<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        // Validate review input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Check if user has purchased this product
        $hasPurchased = OrderItem::whereHas('order', function ($query) {
            $query->where('user_id', Auth::id());
        })->where('product_id', $product->id)->exists();

        if (!$hasPurchased) {
            abort(403, 'You can only review products you purchased.');
        }

        // Save or update the review
        $review = Review::updateOrCreate(
            [
                'user_id'    => Auth::id(),
                'product_id' => $product->id,
            ],
            [
                'rating'  => $request->rating,
                'comment' => $request->comment,
            ]
        );

        return redirect()
            ->back()
            ->with('success', $review->wasRecentlyCreated ? 'Thank you for your review!' : 'Your review has been updated.');
    }
}
