<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreationRequest;
use App\Models\Product;
use App\Services\CommentService;
use Illuminate\Http\RedirectResponse;

class ProductCommentController extends Controller
{
    public function __construct(protected CommentService $service)
    {
    }

    public function store(CommentCreationRequest $request, int $id): RedirectResponse
    {
        $product = Product::query()->published()->findOrFail($id);
        $redirect = redirect()->to(route('products.show', $product->id).'#reviews');

        if ($product->comments()->where('user_id', $request->user()->id)->exists()) {
            return $redirect->withErrors(['message' => 'Anda sudah memberikan ulasan untuk produk ini.']);
        }

        $this->service->create($request->user(), $product, $request->validated());

        return $redirect->with('status', 'Terima kasih atas ulasan Anda!');
    }
}
