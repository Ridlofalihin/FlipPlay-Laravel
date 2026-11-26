<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//formrequest mengubah data media
class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string',
            'genre' => 'nullable|string',
            'synopsis' => 'nullable|string',
            'cover_url' => 'nullable|url',
            'release_year' => 'nullable|integer',
        ];
    }
}
