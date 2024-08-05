<?php

namespace App\Http\Requests\MosqueHistory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;

class UpdateRequest extends FormRequest
{
    public function __construct(ValidationFactory $ValidationFactory)
    {
        $request = $ValidationFactory->getContainer()->request;
        $ValidationFactory->extend(
            'max_files',
            function ($attribute, $value, $parameters) use($request) {
                $count = 0;
                if (is_array($request->images)) {
                    $count += count($request->images);
                }
                if (is_array($request->new_images)) {
                    $count += count($request->new_images);
                }
                if ($count <= $parameters[0]) {
                    return $value;
                }
            },
            trans('validation.max_files')
        );
    }
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

            "text_ru" => "required|string|max:255",
            "text_tt" => "required|string|max:255",

            "new_images" => "required_without:images|nullable|array|max_files:10",
            "new_images.*.image" => "required|file|mimes:png,jpg,bmp,webp",
            "new_images.*.alt_ru" => "required|string|max:100",
            "new_images.*.alt_tt" => "required|string|max:100",

            "images" => "required_without:new_images|nullable|array|max_files:10",
            "images.*.id" => "required|integer",
            "images.*.alt_ru" => "required|string|max:100",
            "images.*.alt_tt" => "required|string|max:100",
            "images.*.sort_index" => "required|integer",

            "delete_imgs_ids" => 'nullable|array',
        ];
    }
}
