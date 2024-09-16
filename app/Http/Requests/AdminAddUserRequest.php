<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class AdminAddUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'username' => ['required', 'string', 'max:15', 'unique:' . User::class],
            'name' => ['required', 'string'],
            'about_me' => ['required', 'string'],
            'status' => ['required','in:active,inactive,blocked'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
