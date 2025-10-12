<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JehemMeadolanController extends Controller
{
    public function index(Request $request): View
    {

        $products = Product::query()
            ->latest()
            ->with('user', 'attachments', 'categories')
            ->where('is_approved', true)
            ->where('is_active', true)
            // Searching Product by name
            ->when($request->has('query') && $request->input('query'), fn ($query) => $query->where('name', 'like', '%'.$query.'%'))
            // Filter Product by category id
            ->when($request->has('category') && $request->input('category'), function ($query) use ($request) {
                $categoryId = $request->input('category');

                return $query->whereHas('categories', function ($query) use ($categoryId) {
                    $query->where('categories.id', $categoryId);
                });
            })
            ->paginate(6);

        // Trending Products
        $slide_products = Product::query()
            ->with('user', 'attachments')
            ->where('is_approved', true)
            ->where('is_active', true)
            ->sortByDesc('visitor_count')
            ->limit(5)
            ->get();
        $reviews = Comment::with('user')->latest()->limit(10)->get();
        $categories = Category::latest()->get();

        return view('jehem-meadolan.home.home', compact('products', 'slide_products', 'query', 'categories', 'reviews'));
    }

    public function about(): View
    {
        return view('jehem-meadolan.about.about');
    }

    public function kontak(): View
    {
        return view('jehem-meadolan.kontak.kontak');
    }

    public function detail($id): View
    {
        $products = Product::query()
            ->where('is_approved', true)
            ->where('is_active', true)
            ->where('id', $id)
            ->with('user', 'attachments')
            ->first();

        if ($products == null) {
            abort(404);
        }

        $reviews = Comment::query()
            ->where('product_id', $id)
            ->with('user')
            ->latest()
            ->paginate(3);

        $product_list = Product::query()
            ->where('is_approved', true)
            ->where('is_active', true)
            ->with('user', 'attachments')
            ->latest()
            ->limit(3)
            ->get();

        return view('jehem-meadolan.detail.detail', compact('products', 'reviews', 'product_list'));
    }

    public function login(): View
    {
        return view('jehem-meadolan.login.login');
    }

    public function register()
    {
        return view('filament.pages.register-page');
    }
}
