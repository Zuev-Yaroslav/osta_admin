<?php

namespace App\Http\Controllers\Admin\Review;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Review\UpdateRequest;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(Review $review, UpdateRequest $req)
    {
        try {
            DB::beginTransaction();
            $data = $req->validated();
    
            $review->update($data);
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
