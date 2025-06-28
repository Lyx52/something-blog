<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'username' => 'required|unique:users|max:64',
            'email' => 'required|email|unique:users|max:128',
            'password' => Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->max(128),
            'password_confirmation' => 'required|same:password|max:128',
        ];
    }
}
