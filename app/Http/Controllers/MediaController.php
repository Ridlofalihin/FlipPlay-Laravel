<?php

namespace App\Http\Controllers;

use App\Models\Media;

use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\Resources\MediaResource;
//CRUD
class MediaController extends Controller
{
    // Menampilkan semua media
    public function index()
    {
        //eager loading
        $media = Media::with('users')->get();

        //API Resource
        return MediaResource::collection($media)
            ->additional([
                'success' => true
            ]);
    }

    // Menambahkan media baru
    public function store(StoreMediaRequest $request)
    {
        $media = Media::create($request->validated());

        //API Resource
        return (new MediaResource($media))
            ->additional([
                'success' => true,
                'message' => 'Media berhasil ditambahkan'
            ])
            ->response()
            ->setStatusCode(201);
    }

    // Menampilkan satu media
    public function show(string $id)
    {
        $media = Media::with('users')->findOrFail($id);

        //API Resource
        return (new MediaResource($media))
            ->additional([
                'success' => true
            ]);
    }

    // Mengubah media
    public function update(UpdateMediaRequest $request, string $id)
    {
        $media = Media::findOrFail($id);

        $media->update($request->validated());

        //API Resource
        return (new MediaResource($media))
            ->additional([
                'success' => true,
                'message' => 'Media berhasil diperbarui'
            ]);
    }

    // Menghapus media
    public function destroy(string $id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil dihapus'
        ]);
    }
}
