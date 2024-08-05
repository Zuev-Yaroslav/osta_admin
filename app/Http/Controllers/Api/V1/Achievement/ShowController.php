<?php

namespace App\Http\Controllers\Api\V1\Achievement;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AchievementResource;
use App\Models\Achievement;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Achievement $achievement)
    {
        return AchievementResource::make($achievement);
    }
}
