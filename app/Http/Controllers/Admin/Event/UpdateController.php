<?php

namespace App\Http\Controllers\Admin\Event;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\UpdateRequest;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(Event $event, UpdateRequest $req)
    {
        $image = null;
        try {
            DB::beginTransaction();
            $data = $req->validated();
            
            if (isset($data['image'])){
                $image = new ImageHelper($data['image']);
                $image->PutImage("event/images");
        
                $data['image'] = $image->path;

                ImageHelper::DeleteImage($event->image);
            }
    
            $event->update($data);
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
