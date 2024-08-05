<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BuildingImage extends Model
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
