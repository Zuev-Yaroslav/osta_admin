<?php

namespace App\Http\Controllers\Admin\Building;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Building\StoreRequest;
use App\Models\Building;
use App\Models\BuildingImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $req)
    {
        $building = null;
        try {
            DB::beginTransaction();
            $data = $req->validated();
        
            $images = $data['images'];
            unset($data['images']);
    
            $building = Building::create($data);

            foreach($images as $key => $val) {
                $image = new ImageHelper($val['image']);
                $image->PutImage("building/$building->id/images");
        
                BuildingImage::create([
                    'building_id' => $building->id,
                    'src' => $image->path,
                    'alt_ru' => $val['alt_ru'],
                    'alt_tt' => $val['alt_tt'],
                    'sort_index' => $key
                ]);
            }
            DB::commit();
            return response([]);
        }catch(Exception $e){
            DB::rollBack();
            if ($building) {
                if (Storage::disk('public')->exists("building/$building->id")) {
                    Storage::disk('public')->deleteDirectory("building/$building->id");
                }
            }

            return response()->json([
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTrace(),
            ], 500);
        }
    }
}
