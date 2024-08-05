<?php

namespace App\Http\Controllers\Admin\Review;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Review\StoreRequest;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->paginate(9);
        foreach ($reviews as $key => $value) {
            $reviews[$key]->text_ru = nl2br($value->text_ru);
        }
        return view('review.index', compact('reviews'));
    }
    public function create()
    {
        return view('review.create');
    }
    public function edit(Review $review)
    {
        return view('review.edit', compact('review'));
    }
}
