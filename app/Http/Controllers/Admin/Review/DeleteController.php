<?php

namespace App\Http\Controllers\Admin\Review;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __invoke(Review $review)
    {
        $review->delete();
        return response([]);
    }
}
