<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'birth_date' => 'date|required',
            'genre' => 'string|max:30',
            'biologic_sex' => 'string|max:30',
            'nationality' => 'string|max:30',
            'place_of_birth' => 'string|max:30',
            'zipcode' => 'string|max:8',
            'number' => 'string|max:20',
            'complement' => 'string|max:20',
            'phone' => 'string|max:20',
            'admin' => 'boolean|required',
        ];
    }
}
