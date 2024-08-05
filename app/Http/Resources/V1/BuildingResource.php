<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuildingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = app()->getLocale();
        return [
            'id' => $this->id,
            'title' => $this["title_$lang"],
            'text' => $this["text_$lang"],
            'compatibility' => $this->compatibility,
            'development' => $this->development["name_$lang"],
            'images' => BuildingImageResource::collection($this->images()->orderBy('sort_index')->get())
        ];
    }
}
