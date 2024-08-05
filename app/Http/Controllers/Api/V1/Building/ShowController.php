<?php

namespace App\Http\Controllers\Api\V1\Building;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BuildingResource;
use App\Models\Building;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Building $building)
    {
        return BuildingResource::make($building);
    }
}
