<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisteredUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birth_date' => 'date',
            'genre' => 'max:30',
            'biologic_sex' => 'max:30',
            'nationality' => 'max:30',
            'place_of_birth' => 'max:30',
            'phone' => 'max:20',
            'zipcode' => 'max:8',
            'number' => 'max:20',
            'complement' => 'max:20',
        ];
    }
}
