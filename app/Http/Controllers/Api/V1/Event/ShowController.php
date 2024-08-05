<?php

namespace App\Http\Controllers\Api\V1\Event;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Event $event)
    {
        return EventResource::make($event);
    }
}
