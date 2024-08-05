<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Building extends Model
{
    use HasFactory;
    use Filterable;
    protected $guarded = [];

    public function images() {
        return $this->hasMany(BuildingImage::class, 'building_id', 'id');
    }

    public function development() : BelongsTo
    {
        return $this->belongsTo(Development::class, 'development_id', 'id');
    }

    public function getFirstImage() {
        $images = $this->images();
        $image = $images->orderBy('sort_index')->first();
        return $image;
    }
}
