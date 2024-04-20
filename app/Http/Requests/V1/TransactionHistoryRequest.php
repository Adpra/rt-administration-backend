<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class TransactionHistoryRequest extends FormRequest
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
                'type' => 'required|max:255',
                'status' => 'required|numeric',
                'amount' => 'required|numeric',
                'description' => 'required|max:255',
            ];
        }

        if (request()->isMethod('PUT')) {
            $rules = [
                'type' => 'required|max:255',
                'status' => 'required|numeric',
                'amount' => 'required|numeric',
                'description' => 'required|max:255',

            ];
        }

        return $rules;
    }
}
