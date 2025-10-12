<?php

namespace App\Filament\Pages;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Services\VisitorService;
use Filament\Pages\SimplePage;
use Illuminate\Support\Carbon;

class HomePage extends SimplePage
{
    private VisitorService $visitorService;

    public function __construct()
    {
        $this->visitorService = new VisitorService();
    }

    protected static string $view = 'jehem-meadolan.home.home';

    protected static string $layout = 'jehem-meadolan.home.home';

    public array $products = [];

    public array $slide_products = [];

    public array $reviews = [];

    public array $categories = [];

    public function mount(): void
    {
        $this->defineProducts();
        $this->countVisitor();
    }

    private function countVisitor()
    {
        $date = Carbon::now();
        $this->visitorService->updateCountVisitor($date->day, $date->month, $date->year);
    }

    private function defineProducts()
    {
        $searchInput = request()->input('query');
        $categoryId = request()->input('category');

        $this->products = Product::query()
            ->with('user', 'attachments')
            // Get Approved Product
            ->where('is_approved', true)
            // Get Active Product
            ->where('is_active', true)
            // Filter Products By Category
            ->when($categoryId && $categoryId !== 'All', function ($query) use ($categoryId) {
                return $query->whereHas('categories', function ($subQuery) use ($categoryId) {
                    $subQuery->where('categories.id', $categoryId);
                });
            })
            // Search Product by name
            ->when($searchInput, fn ($query) => $query->where('name', 'like', '%'.$searchInput.'%'))
            ->latest()
            ->paginate(6)
            ->toArray();

        $this->reviews = Comment::query()
            ->with('user')
            ->latest()
            ->paginate(6)
            ->toArray();

        $this->slide_products = Product::query()
            ->where('is_approved', true)
            ->where('is_active', true)
            ->with('user', 'attachments')
            ->latest()
            ->paginate(5)
            ->toArray();

        $this->categories = Category::all()->toArray();
    }

    protected function getData(): array
    {
        $user = auth()->user() === null ? null : auth()->user()->toArray();

        return [
            'products' => $this->products,
            'categories' => $this->categories,
            'slide_products' => $this->slide_products,
            'reviews' => $this->reviews,
            'user' => $user,
        ];
    }

    protected function getViewData(): array
    {
        return $this->getData();
    }

    protected function getLayoutData(): array
    {
        return $this->getData();
    }

    public static function getView(): string
    {
        return self::$view;
    }
}
