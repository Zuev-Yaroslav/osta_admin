<?php

namespace App\Http\Controllers\Admin\MosqueHistory;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\MosqueHistory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __invoke(MosqueHistory $mosqueHistory)
    {
        $mosqueHistory->images()->delete();
        $mosqueHistory->delete();
        if (Storage::exists("mosque-history/$mosqueHistory->id")) {
            Storage::deleteDirectory("mosque-history/$mosqueHistory->id");
        }
        return response([]);
    }
}
