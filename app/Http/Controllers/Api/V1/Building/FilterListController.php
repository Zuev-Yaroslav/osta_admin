<?php

namespace App\Http\Controllers\Api\V1\Building;

use App\Http\Controllers\Controller;
use App\Http\Filters\BuildingFilter;
use App\Http\Requests\Building\FilterRequest;
use App\Http\Resources\V1\BuildingResource;
use App\Models\Building;
use App\Models\Development;
use Illuminate\Http\Request;

class FilterListController extends Controller
{
    public function __invoke(Request $request)
    {
        $developments = Development::select("id", "name_". app()->getLocale(). " as name")->get();

        $compatibilityMin = 0;
        $compatibilityMax = 0;
        
        if (Building::count() > 0){
            $compatibilityMin = Building::orderBy('compatibility')->first()->compatibility;
            $compatibilityMax = Building::orderByDesc('compatibility')->first()->compatibility;
        }

        return response()->json([
            'developments' => $developments,
            'compatibilityMin' => $compatibilityMin,
            'compatibilityMax' => $compatibilityMax
        ]);
    }
}
