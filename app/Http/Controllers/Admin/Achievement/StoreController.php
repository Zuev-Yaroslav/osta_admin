<?php

namespace App\Http\Controllers\Admin\Achievement;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Achievement\StoreRequest;
use App\Models\Achievement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $req)
    {
        $image = null;
        try {
            DB::beginTransaction();
            $data = $req->validated();
        
            $image = new ImageHelper($data['image']);
            $image->PutImage("achievement/images");
    
            $data['image'] = $image->path;
    
            Achievement::create($data);
            DB::commit();
            return response([]);
        }catch(Exception $e){
            DB::rollBack();
            if ($image) {
                ImageHelper::DeleteImage($image->path);
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
