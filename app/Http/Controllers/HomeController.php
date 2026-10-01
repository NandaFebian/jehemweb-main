<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Services\VisitorService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(Request $request, VisitorService $visitorService): View
    {
        $visitorService->recordVisit();

        $search = trim((string) $request->query('query'));
        $categoryId = $request->query('category');

        $products = Product::query()
            ->published()
            ->with('user', 'attachments')
            ->when($categoryId, fn ($query) => $query->whereHas(
                'categories',
                fn ($categories) => $categories->whereKey($categoryId),
            ))
            ->when($search !== '', fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->latest()
            ->paginate(6)
            ->withQueryString()
            ->fragment('product');

        $trendingProducts = Product::query()
            ->published()
            ->with('user', 'attachments')
            ->orderByDesc('visitor_count')
            ->limit(5)
            ->get();

        return view('pages.home', [
            'products' => $products,
            'trendingProducts' => $trendingProducts,
            'categories' => Category::query()->orderBy('name')->get(),
            'reviews' => Comment::query()->with('user')->where('is_active', true)->latest()->limit(6)->get(),
            'search' => $search,
            'activeCategory' => $categoryId,
        ]);
    }
}
