<?php

namespace App\Http\Controllers\Admin\TextImage;

use Exception;
use App\Models\TextImage;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TextImage\UpdateRequest;

class UpdateController extends Controller
{
    public function __invoke(TextImage $textImage, UpdateRequest $req)
    {
        $image = null;
        try {
            DB::beginTransaction();
            $data = $req->validated();
    
            $textImage->update($data);
            DB::commit();
            return response([]);
        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTrace(),
            ], 500);
        }
    }
}
