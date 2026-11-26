<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//formrequest menambahkan media baru
class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'genre' => 'nullable|string',
            'synopsis' => 'nullable|string',
            'cover_url' => 'nullable|url',
            'release_year' => 'nullable|integer',
        ];
    }
}
