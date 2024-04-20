<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class HouseHolderRequest extends FormRequest
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
                // 'photo_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required|numeric',
                'marital_status' => 'required|max:255',
                'phone' => 'required|max:255',
            ];
        }

        if (request()->isMethod('PUT')) {
            $rules = [
                'name' => 'required|max:255',
                // 'photo_ktp' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required|numeric',
                'marital_status' => 'required|max:255',
                'phone' => 'required|max:255',
            ];
        }

        return $rules;
    }
}
