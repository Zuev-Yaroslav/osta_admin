<?php

namespace App\Http\Controllers\Admin\Achievement;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Achievement\StoreRequest;
use App\Models\Achievement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::latest()->paginate(9);
        return view('achievement.index', compact('achievements'));
    }
    public function create()
    {
        return view('achievement.create');
    }
    public function edit(Achievement $achievement)
    {
        return view('achievement.edit', compact('achievement'));
    }
}
