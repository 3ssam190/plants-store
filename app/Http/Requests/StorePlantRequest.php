<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
{
    return [
        'name' => 'required|string|max:255',
        'type' => 'required|in:flower,succulent,tree',
        'price' => 'required|numeric|min:0',
        'environment' => 'required|in:indoor,outdoor',
        'image' => 'nullable|image|max:2048'
    ];
}
}
