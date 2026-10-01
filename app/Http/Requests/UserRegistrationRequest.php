<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20', 'regex:/^\+?[0-9]{6,20}$/', 'unique:users,phone_number'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'phone_number.unique' => 'Nomor telepon sudah terdaftar, silahkan gunakan nomor lain.',
            'phone_number.regex' => 'Nomor telepon hanya boleh berisi angka.',
            'password.confirmed' => 'Konfirmasi password tidak sama dengan password.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nama usaha',
            'phone_number' => 'nomor telepon',
        ];
    }
}
