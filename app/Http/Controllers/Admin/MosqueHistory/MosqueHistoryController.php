<?php

namespace App\Http\Controllers\Admin\MosqueHistory;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\MosqueHistory\StoreRequest;
use App\Models\MosqueHistory;
use App\Models\Development;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MosqueHistoryController extends Controller
{
    public function index()
    {
        $mosqueHistories = MosqueHistory::latest()->paginate(9);

        return view('mosque-history.index', compact('mosqueHistories'));
    }
    public function create()
    {
        return view('mosque-history.create');
    }
    public function edit(MosqueHistory $mosqueHistory)
    {
        return view('mosque-history.edit', compact('mosqueHistory'));
    }
}
