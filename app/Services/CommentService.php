<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CommentService
{
    public function paginated(array $params = []): LengthAwarePaginator
    {
        return Comment::query()
            ->with('user:id,name,profile_image_path')
            ->where('is_active', true)
            ->when(isset($params['product_id']), fn ($query) => $query->where('product_id', $params['product_id']))
            ->when(isset($params['user_id']), fn ($query) => $query->where('user_id', $params['user_id']))
            ->latest()
            ->paginate();
    }

    /**
     * @param  array{rating: int, message: string}  $data
     */
    public function create(User $user, Product $product, array $data): Comment
    {
        return $product->comments()->create([
            'user_id' => $user->id,
            'rating' => $data['rating'],
            'message' => $data['message'],
            'is_active' => true,
        ]);
    }
}
