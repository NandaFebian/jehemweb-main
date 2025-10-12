<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function __construct(protected Product $model)
    {
    }

    public function paginated(array $params = [])
    {
        return Product::query()
            ->when(isset($params['category_id']), fn ($query) => $query->whereHas('categories', fn ($subQuery) => $subQuery->where('id', $params['category_id'])))
            ->when(isset($params['search']), fn ($query) => $query->where('LOWER(name)', 'LIKE', '%'.strtolower($params['search']).'%'))
            ->latest()
            ->paginate();
    }

    public function create(array $data = [])
    {
        $data['user_id'] = auth()->user()->id;

        return Product::create($data);
    }

    public function detail($id)
    {
        return Product::findOrFail($id);
    }
}
