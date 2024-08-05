<?php

namespace App\Http\Controllers\Admin\Event;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __invoke(Event $event)
    {
        ImageHelper::DeleteImage($event->image);
        $event->delete();
        return response([]);
    }
}
