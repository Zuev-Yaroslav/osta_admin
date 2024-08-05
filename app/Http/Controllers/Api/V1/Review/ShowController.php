<?php

namespace App\Http\Controllers\Api\V1\Review;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Review $review)
    {
        return ReviewResource::make($review);
    }
}
