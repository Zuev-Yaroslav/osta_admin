<?php

namespace App\Http\Controllers\Admin\Building;

use Exception;
use App\Models\Building;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Models\BuildingImage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Building\UpdateRequest;

class UpdateController extends Controller
{
    public function __invoke(Building $building, UpdateRequest $req)
    {
        $imagesForDelete = [];
        try {
            DB::beginTransaction();
            $data = $req->validated();
        
            $images = (isset($data['images'])) ? $data['images'] : null;
            $newImages = (isset($data['new_images'])) ? $data['new_images'] : null;
            $deleteImgsIds = (isset($data['delete_imgs_ids'])) ? $data['delete_imgs_ids'] : null;
            unset($data['images']);
            unset($data['new_images']);
            unset($data['delete_imgs_ids']);

            if ($images) {
                foreach($images as $key => $val) {
                    $buildingImage = BuildingImage::find($val['id']);
                    if ($buildingImage) {
                        $buildingImage->update([
                            'alt_ru' => $val['alt_ru'],
                            'alt_tt' => $val['alt_tt'],
                            'sort_index' => $val['sort_index']
                        ]);
                    }
                }
            }
            if ($newImages) {
                foreach($newImages as $key => $val) {
                    $image = new ImageHelper($val['image']);
                    $image->PutImage("building/$building->id/images");
                    array_push($imagesForDelete, $image->path);
                    BuildingImage::create([
                        'building_id' => $building->id,
                        'src' => $image->path,
                        'alt_ru' => $val['alt_ru'],
                        'alt_tt' => $val['alt_tt'],
                        'sort_index' => count($images) + $key
                    ]);
                }
            }
            if ($deleteImgsIds) {
                foreach ($deleteImgsIds as $id) {
                    $buildingImage = BuildingImage::find($id);
                    if ($buildingImage) {
                        $buildingImage->delete();
                        ImageHelper::DeleteImage($buildingImage->src);
                    }
                }
            }
            DB::commit();
            return response([]);
        }catch(Exception $e){
            DB::rollBack();
            if ($imagesForDelete) {
                foreach ($imagesForDelete as $val) {
                    ImageHelper::DeleteImage($val);
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
