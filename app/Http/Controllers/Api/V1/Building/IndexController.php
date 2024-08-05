<?php

namespace App\Http\Controllers\Api\V1\Building;

use App\Http\Controllers\Controller;
use App\Http\Filters\BuildingFilter;
use App\Http\Requests\Building\FilterRequest;
use App\Http\Resources\V1\BuildingResource;
use App\Models\Building;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(BuildingFilter::class, ['queryParams' => array_filter($data)]);
        $limit = ($request->limit) ? $request->limit : null;
        if ($limit)
            $buildings = Building::latest()->filter($filter)->paginate($limit);
        else
            $buildings = Building::latest()->filter($filter)->get();
        return BuildingResource::collection($buildings);
    }
}
