<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    // Menampilkan semua media
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Media::latest()->get()
        ]);
    }

    // Menambahkan media baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:anime,manga,drama,novel',
            'genre' => 'nullable|string',
            'synopsis' => 'nullable|string',
            'cover_url' => 'nullable|url',
            'release_year' => 'nullable|integer|min:1900|max:2100',
        ]);

        $media = Media::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil ditambahkan',
            'data' => $media
        ], 201);
    }

    // Menampilkan satu media
    public function show(string $id)
    {
        $media = Media::with('users:id,name')
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $media
        ]);
    }

    // Mengubah media
    public function update(Request $request, string $id)
    {
        $media = Media::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|in:anime,manga,drama,novel',
            'genre' => 'nullable|string',
            'synopsis' => 'nullable|string',
            'cover_url' => 'nullable|url',
            'release_year' => 'nullable|integer|min:1900|max:2100',
        ]);

        $media->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil diperbarui',
            'data' => $media
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
