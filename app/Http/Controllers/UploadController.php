<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        // Validate the PDF file
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:10240' // 10MB max
        ]);

        // Store the file
        $path = $request->file('pdf')->store('pdfs');

        return response()->json([
            'success' => true,
            'path' => $path
        ]);
    }
}