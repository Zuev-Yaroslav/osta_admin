<?php

namespace App\Http\Controllers\Api\V1\Application;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\StoreRequest;
use App\Mail\Application\ApplicationMail;
use App\Models\Application;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $req)
    {
        try {
            DB::beginTransaction();

            $data = $req->validated();
            unset($data['data_transfer_condition']);
            Mail::to(config('mail.mailers.smtp.username'))->send(new ApplicationMail($req->name, $req->email, $req->phone));

            Application::create($data);
            
            DB::commit();
            return response([]);
        } catch (Exception $e) {
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
