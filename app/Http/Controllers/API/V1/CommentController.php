<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentCreationRequest;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(protected CommentService $service)
    {
    }

    public function paginated(Request $request)
    {
        return $this->service->paginated($request->toArray());
    }

    public function create(CommentCreationRequest $request)
    {
        return $this->service->create([
            'message' => $request->message,
            'rating' => $request->rating,
            'product_id' => $request->product_id,
            'is_active' => true,
        ]);
    }
}
