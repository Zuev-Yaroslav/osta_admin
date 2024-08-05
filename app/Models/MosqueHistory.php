<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MosqueHistory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(MosqueHistoryImage::class, 'mosque_history_id', 'id');
    }

    public function getFirstImage()
    {
        $images = $this->images();
        $image = $images->orderBy('sort_index')->first();
        return $image;
    }
}
