<?php

namespace App\Http\Controllers\Admin\History;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\History\UpdateRequest;
use App\Models\History;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $req)
    {
        try {
            DB::beginTransaction();
            $history = History::first();
            $data = $req->validated();
    
            $history->update($data);
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
