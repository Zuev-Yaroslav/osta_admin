<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImageUrl()
    {
        $url = asset($this->image);
        if (Storage::disk('public')->exists($this->image))
            $url = asset("storage/$this->image");
        return $url;
    }
}
