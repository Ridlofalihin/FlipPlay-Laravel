<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\AuthController;
use App\Models\Media;

// Register dan Login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Fitur yang membutuhkan login
Route::middleware('auth:sanctum')->group(function () {

    // Cek user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Menambahkan media ke koleksi (Attach)
    Route::post('/media/{id}/collection', function (Request $request, $id) {
        $media = Media::findOrFail($id);

        $request->user()->media()->syncWithoutDetaching([$media->id]);

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil ditambahkan ke koleksi'
        ]);
    });

    // Menampilkan koleksi pengguna
    Route::get('/collection', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => $request->user()->media
        ]);
    });

    // Menghapus media dari koleksi (Detach)
    Route::delete('/media/{id}/collection', function (Request $request, $id) {
        $media = Media::findOrFail($id);

        $request->user()->media()->detach($media->id);

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil dihapus dari koleksi'
        ]);
    });
});

// API CRUD Media
Route::apiResource('media', MediaController::class);
