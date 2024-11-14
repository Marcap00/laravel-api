<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Auth::check()) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'author' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255', 'unique:projects,title'],
            'description' => ['required', 'string', 'max:255'],
            'type_id' => ['required', 'numeric', 'integer', 'exists:types,id'],
            'technologies' => ['array'],
            'technologies.*' => ['integer', 'numeric', 'exists:technologies,id', 'min:1'],
            'image' => ['image', 'max:250']
        ];
    }
}
