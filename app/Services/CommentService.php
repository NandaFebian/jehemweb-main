<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function __construct(protected Comment $model)
    {
    }

    public function paginated(array $params = [])
    {
        return Comment::query()
            ->when(isset($params['product_id']), fn ($query) => $query->where('product_id', $params['product_id']))
            ->when(isset($params['user_id']), fn ($query) => $query->where('user_id', $params['user_id']))
            ->latest()
            ->paginate();
    }

    public function create(array $data = [])
    {
        $data['user_id'] = auth()->user()->id;

        return Comment::create($data);
    }
}
