<?php

namespace App\Http\Controllers\Api\V1\History;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\HistoryResource;
use App\Models\History;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $history = History::first();
        return HistoryResource::make($history);
    }
}
