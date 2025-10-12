<?php

namespace App\Filament\Pages;

use App\Models\Comment;
use App\Models\Product;
use Filament\Pages\SimplePage;

class AboutPage extends SimplePage
{
    protected static string $layout = 'jehem-meadolan.about.about';

    protected static string $view = 'jehem-meadolan.about.about';

    public array $products = [];

    public array $reviews = [];

    public function mount(): void
    {
        $this->defineProducts();
    }

    private function defineProducts()
    {
        $this->products = Product::query()
            // Get Approved Product
            ->where('is_approved', true)
            // Get Active Product
            ->where('is_active', true)
            ->with('user', 'attachments')
            ->latest()
            ->paginate(6)
            ->toArray();

        $this->reviews = Comment::query()
            ->with('user')
            ->paginate(6)
            ->toArray();
    }

    protected function getData(): array
    {
        $user = auth()->user() === null ? null : auth()->user()->toArray();

        return [
            'products' => $this->products,
            'user' => $user,
            'reviews' => $this->reviews,
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
