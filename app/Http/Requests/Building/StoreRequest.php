<?php

namespace App\Http\Requests\Building;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title_ru" => "required|string|max:100",
            "title_tt" => "required|string|max:100",

            "text_ru" => "required|string",
            "text_tt" => "required|string",

            "compatibility" => "required|integer",
            "development_id" => "required|integer",

            "images" => "required|array|max:10",
            "images.*.image" => "required|file|mimes:png,jpg,bmp,webp",
            "images.*.alt_ru" => "required|string|max:100",
            "images.*.alt_tt" => "required|string|max:100"
        ];
    }
}
