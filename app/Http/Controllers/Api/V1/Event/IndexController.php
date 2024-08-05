<?php

namespace App\Http\Controllers\Api\V1\Event;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $limit = ($request->limit) ? $request->limit : null;
        if ($limit)
            $events = Event::latest()->paginate($limit);
        else
            $events = Event::latest()->get();
        return EventResource::collection($events);
    }
}
