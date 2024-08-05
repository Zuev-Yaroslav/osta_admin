<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function __construct(ValidationFactory $ValidationFactory)
    {
        $ValidationFactory->extend(
            'true',
            function ($attribute, $value, $parameters) {
                if ((boolean)$value) {
                    return (boolean)$value;
                }
            },
            trans('validation.true')
        );
    }
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|regex:/^\+7 \d{3} \d{3}-\d{2}-\d{2}$/i',

            'data_transfer_condition' => 'required|boolean|true'
        ];
    }
}
