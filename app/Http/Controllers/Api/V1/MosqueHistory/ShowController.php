<?php

namespace App\Http\Controllers\Api\V1\MosqueHistory;

use Illuminate\Http\Request;
use App\Models\MosqueHistory;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BuildingResource;
use App\Http\Resources\V1\MosqueHistoryResource;

class ShowController extends Controller
{
    public function __invoke(MosqueHistory $mosqueHistory)
    {
        return MosqueHistoryResource::make($mosqueHistory);
    }
}
