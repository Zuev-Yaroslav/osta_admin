<?php

namespace App\Http\Controllers\Admin\TextImage;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\TextImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __invoke(TextImage $textImage)
    {
        ImageHelper::DeleteImage($textImage->image);
        $textImage->delete();
        return response([]);
    }
}
