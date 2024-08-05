<?php

namespace App\Http\Controllers\Admin\Achievement;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __invoke(Achievement $achievement)
    {
        ImageHelper::DeleteImage($achievement->image);
        $achievement->delete();
        return response([]);
    }
}
