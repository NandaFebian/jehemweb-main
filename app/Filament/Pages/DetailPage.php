<?php

namespace App\Filament\Pages;

use App\Models\Comment;
use App\Models\Product;
use Filament\Pages\SimplePage;

class DetailPage extends SimplePage
{
    protected static string $layout = 'jehem-meadolan.detail.detail';

    protected static string $view = 'jehem-meadolan.detail.detail';

    public array $product = [];

    public array $products = [];

    public array $product_list = [];

    public array $reviews = [];

    public ?Comment $comment = null;

    public function mount(): void
    {
        $this->defineProducts();
        $this->defineComment();
    }

    private function defineComment()
    {
        $productId = request()->route('id');
        $user = auth()->user();
        if ($user) {
            $this->comment = Comment::where('product_id', $productId)
                ->where('user_id', $user->id)
                ->first();
        }
    }

    private function defineProducts()
    {
        $productId = request()->route('id');

        $product = Product::query()
            // Get Approved Product
            ->where('is_approved', true)
            // Get Active Product
            ->where('is_active', true)
            ->with('user', 'attachments', 'comments')
            ->where('id', $productId)
            ->first();
        if ($product === null) {
            abort(404, 'Data Tidak Ditemukan');
        }
        $product->visitor_count += 1;
        $product->save();
        $this->product = $product ? $product->toArray() : [];

        // Footer Product
        $this->products = Product::query()
            // Get Approved Product
            ->where('is_approved', true)
            // Get Active Product
            ->where('is_active', true)
            ->latest()
            ->paginate(6)
            ->toArray();

        $this->reviews = Comment::query()
            ->with('user')
            ->where('product_id', $productId)
            ->paginate(3)
            ->toArray();

        $this->product_list = Product::query()
            ->with('user', 'attachments')
            // Get Approved Product
            ->where('is_approved', true)
            // Get Active Product
            ->where('is_active', true)
            ->paginate(3)
            ->toArray();

    }

    protected function getData(): array
    {
        $user = auth()->user() === null ? null : auth()->user()->toArray();

        return [
            'product' => $this->product,
            'products' => $this->products,
            'reviews' => $this->reviews,
            'product_list' => $this->product_list,
            'own_comment' => $this->comment,
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
