<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GitHubController extends Controller
{
    public function index(Request $request)
    {
        try {
            $state = $request->query('state', 'open');
            
            $response = Http::get('https://api.github.com/repos/josh-zanecoder/josh-zanecoder/pulls', [
                'state' => $state,
                'per_page' => 100
            ]);

            if (!$response->successful()) {
                throw new \Exception('GitHub API request failed');
            }

            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch pull requests'], 500);
        }
    }
} 