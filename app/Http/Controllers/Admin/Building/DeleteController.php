<?php

namespace App\Http\Controllers\Admin\Building;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Building;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __invoke(Building $building)
    {
        $building->images()->delete();
        $building->delete();
        if (Storage::exists("building/$building->id")) {
            Storage::deleteDirectory("building/$building->id");
        }
        return response([]);
    }
}
