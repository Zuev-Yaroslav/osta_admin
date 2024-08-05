<?php

namespace App\Http\Controllers\Admin\MosqueHistory;

use Exception;
use App\Models\MosqueHistory;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Models\MosqueHistoryImage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MosqueHistory\UpdateRequest;

class UpdateController extends Controller
{
    public function __invoke(MosqueHistory $mosqueHistory, UpdateRequest $req)
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
                    $mosqueHistoryImage = MosqueHistoryImage::find($val['id']);
                    if ($mosqueHistoryImage) {
                        $mosqueHistoryImage->update([
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
                    $image->PutImage("mosque-history/$mosqueHistory->id/images");
                    array_push($imagesForDelete, $image->path);
                    MosqueHistoryImage::create([
                        'mosque_history_id' => $mosqueHistory->id,
                        'src' => $image->path,
                        'alt_ru' => $val['alt_ru'],
                        'alt_tt' => $val['alt_tt'],
                        'sort_index' => count($images) + $key
                    ]);
                }
            }
            if ($deleteImgsIds) {
                foreach ($deleteImgsIds as $id) {
                    $mosqueHistoryImage = MosqueHistoryImage::find($id);
                    if ($mosqueHistoryImage) {
                        $mosqueHistoryImage->delete();
                        ImageHelper::DeleteImage($mosqueHistoryImage->src);
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
