<?php

namespace App\Http\Controllers\Api\V1\MosqueHistory;

use Illuminate\Http\Request;
use App\Models\MosqueHistory;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BuildingResource;
use App\Http\Resources\V1\MosqueHistoryResource;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $limit = ($request->limit) ? $request->limit : null;
        if ($limit)
            $mosqueHistories = MosqueHistory::latest()->paginate($limit);
        else
            $mosqueHistories = MosqueHistory::latest()->get();
        return MosqueHistoryResource::collection($mosqueHistories);
    }
}
