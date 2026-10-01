<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(protected CommentService $service)
    {
    }

    public function paginated(Request $request)
    {
        return $this->service->paginated($request->only('product_id', 'user_id'));
    }
}
