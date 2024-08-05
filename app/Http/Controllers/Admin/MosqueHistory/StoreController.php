<?php

namespace App\Http\Controllers\Admin\MosqueHistory;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\MosqueHistory\StoreRequest;
use App\Models\MosqueHistory;
use App\Models\MosqueHistoryImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $req)
    {
        $mosqueHistory = null;
        try {
            DB::beginTransaction();
            $data = $req->validated();
        
            $images = $data['images'];
            unset($data['images']);
    
            $mosqueHistory = MosqueHistory::create($data);

            foreach($images as $key => $val) {
                $image = new ImageHelper($val['image']);
                $image->PutImage("mosque-history/$mosqueHistory->id/images");
        
                MosqueHistoryImage::create([
                    'mosque_history_id' => $mosqueHistory->id,
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
            if ($mosqueHistory) {
                if (Storage::disk('public')->exists("mosque-history/$mosqueHistory->id")) {
                    Storage::disk('public')->deleteDirectory("mosque-history/$mosqueHistory->id");
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
