<?php

namespace App\Http\Requests;

use Filament\Facades\Filament;
use Illuminate\Foundation\Http\FormRequest;

class CommentCreationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Filament::auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rating' => ['required', 'numeric', 'max:5', 'min:1'],
            'message' => ['required', 'string', 'max:250'],
            'product_id' => ['required'],
        ];
    }
}
