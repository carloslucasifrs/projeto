<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreLaboratoryexamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'exam' => ['string'],
            'description' => ['string', 'required'],
            'material' => ['nullable', 'string'],
            'method' => ['nullable', 'string'],
            'use' => ['nullable', 'string'],
            'bibliography' => ['nullable', 'string'],
        ];
    }
}
