<?php

namespace App\Http\Controllers\Admin\Event;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreRequest;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(9);
        return view('event.index', compact('events'));
    }
    public function create()
    {
        return view('event.create');
    }
    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
    }
}
