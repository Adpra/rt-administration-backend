<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class HouseRequest extends FormRequest
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
        if (request()->isMethod('POST')) {
            $rules = [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'status' => 'required|numeric',
                'user_id' => 'required|numeric',
            ];
        }

        if (request()->isMethod('PUT')) {
            $rules = [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'status' => 'required|numeric',
                'user_id' => 'required|numeric',
            ];
        }

        return $rules;
    }
}
