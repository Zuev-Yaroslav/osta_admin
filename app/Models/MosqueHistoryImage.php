<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MosqueHistoryImage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getSrcUrl()
    {
        $url = asset($this->src);
        if (Storage::disk('public')->exists($this->src))
            $url = asset("storage/$this->src");
        return $url;
    }
}
