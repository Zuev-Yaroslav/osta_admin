<?php

namespace App\Http\Controllers\Admin\Building;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Building\StoreRequest;
use App\Models\Building;
use App\Models\Development;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BuildingController extends Controller
{
    public function index()
    {
        $buildings = Building::latest()->paginate(9);

        
        return view('building.index', compact('buildings'));
    }
    public function create()
    {
        $developments = Development::all();
        return view('building.create', compact('developments'));
    }
    public function edit(Building $building)
    {
        $developments = Development::all();
        return view('building.edit', compact('building', 'developments'));
    }
}
