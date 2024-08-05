<?php

namespace App\Http\Controllers\Api\V1\Achievement;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AchievementResource;
use App\Models\Achievement;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $limit = ($request->limit) ? $request->limit : null;
        if ($limit)
            $achievements = Achievement::latest()->paginate($limit);
        else 
            $achievements = Achievement::latest()->get();
        return AchievementResource::collection($achievements);
    }
}
