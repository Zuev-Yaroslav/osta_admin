<?php

namespace App\Http\Controllers\Api\V1\Review;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        // $limit = ($request->limit) ? $request->limit : 3;
        // $reviews = Review::latest()->paginate($limit);
        $reviews = Review::latest()->get();
        return ReviewResource::collection($reviews);
    }
}
