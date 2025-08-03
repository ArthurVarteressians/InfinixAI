<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DemoRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        try {
            $response = Http::asForm()->post(config('services.formspree.endpoint'), [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'company' => $validated['company'] ?? '',
                'message' => $validated['message'] ?? '',
                '_subject' => 'New Demo Request from ' . $validated['name'],
            ]);

            if ($response->successful()) {
                return response()->json(['message' => 'Request submitted successfully']);
            }

            Log::error('Formspree API error', ['response' => $response->body()]);
            return response()->json(['error' => 'Submission failed'], 500);
        } catch (\Exception $e) {
            Log::error('Demo request failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }
}
