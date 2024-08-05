<?php

namespace App\Http\Controllers\Admin\History;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\History\StoreRequest;
use App\Models\History;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HistoryController extends Controller
{
    public function index()
    {
        $history = History::first();
        return view('history.index', compact('history'));
    }
}
