<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
// API Resource Mengatur format response data media
class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'genre' => $this->genre,
            'synopsis' => $this->synopsis,
            'cover_url' => $this->cover_url,
            'release_year' => $this->release_year,

            'users' => UserResource::collection(
                $this->whenLoaded('users')
            ),
        ];
    }
}
