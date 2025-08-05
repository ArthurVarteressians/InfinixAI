<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return Inertia::render('MainWebLandingPage');
})->name('home');

Route::get('clientLogin', function () {
    return Inertia::render('auth/Login', [
        'canResetPassword' => Route::has('password.request'),
    ]);
})->name('clientLogin');

Route::get('clientRegistration', function () {
    return Inertia::render('auth/Register');
})->name('clientRegistration');

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::get('/chat', function () {
    return Inertia::render('QuickChatPage');
})->name('chat');


Route::post('/upload-pdf', function (Request $request) {
    $request->validate(['pdf' => 'required|file|mimes:pdf|max:10240']);

    try {
        $file = $request->file('pdf');
        $originalName = $file->getClientOriginalName();
        $path = $file->storeAs('pdfs', $originalName, 'public');

        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully',
            'path' => str_replace('pdfs/', '', $path), // Just the filename
            'url' => asset('storage/' . $path),
            'original_name' => $originalName
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Upload failed: ' . $e->getMessage()
        ], 500);
    }
});






Route::post('/proxy-ml-chat', function (Request $request) {
    try {
        $response = Http::post('http://localhost:5000/api/chat', [
            'message' => $request->input('message')
        ]);

        return $response->json();
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'ML server unreachable',
            'details' => $e->getMessage()
        ], 500);
    }
});



require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
