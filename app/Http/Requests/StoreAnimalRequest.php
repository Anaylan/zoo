<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAnimalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // return [];
        return [
            'name' => 'required|string|max:100',
            'species' => 'required|string',
            'age' => 'required|numeric|min:0',
            'description' => 'required|string|max:1500',
            'cage_id' => 'required|exists:cages,id',
        ];
    }
}
