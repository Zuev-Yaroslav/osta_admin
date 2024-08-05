<?php

namespace App\Http\Controllers\Admin\TextImage;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreRequest;
use App\Models\Event;
use App\Models\TextImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function __invoke()
    {
        $images = TextImage::latest()->paginate(9);
        return view("image-browser.index", compact('images'));
    }
}
