<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function show(Request $request, int $id): View
    {
        $product = Product::query()
            ->published()
            ->with('user', 'attachments')
            ->withAvg('comments', 'rating')
            ->findOrFail($id);

        $product->increment('visitor_count');

        $reviews = $product->comments()
            ->with('user')
            ->where('is_active', true)
            ->latest()
            ->paginate(3)
            ->fragment('reviews');

        $relatedProducts = Product::query()
            ->published()
            ->with('user', 'attachments')
            ->whereKeyNot($product->id)
            ->latest()
            ->limit(3)
            ->get();

        $hasCommented = $request->user() !== null
            && $product->comments()->where('user_id', $request->user()->id)->exists();

        return view('pages.product', compact('product', 'reviews', 'relatedProducts', 'hasCommented'));
    }
}
