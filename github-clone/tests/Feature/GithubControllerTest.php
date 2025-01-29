<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

class GitHubControllerTest extends TestCase
{
    /** @test */
    public function it_can_fetch_pull_requests()
    {
        // Mock the GitHub API response
        Http::fake([
            'api.github.com/repos/josh-zanecoder/josh-zanecoder/pulls*' => Http::response([
                [
                    'id' => 1,
                    'title' => 'Test PR',
                    'state' => 'open',
                    'user' => ['login' => 'testuser'],
                    'created_at' => now()->toISOString(),
                    'html_url' => 'https://github.com/test/test/pull/1',
                    'number' => 1,
                    'labels' => []
                ]
            ], 200)
        ]);

        // Test the endpoint
        $response = $this->get('/api/pulls?state=open');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    '*' => [
                        'id',
                        'title',
                        'state',
                        'user' => ['login'],
                        'created_at',
                        'html_url',
                        'number',
                        'labels'
                    ]
                ]);
    }

    /** @test */
    public function it_handles_github_api_errors()
    {
        // Mock API error
        Http::fake([
            'api.github.com/*' => Http::response(null, 500)
        ]);

        $response = $this->get('/api/pulls');

        $response->assertStatus(500)
                ->assertJson(['error' => 'Failed to fetch pull requests']);
    }

    /** @test */
    public function it_can_filter_pull_requests_by_state()
    {
        Http::fake([
            'api.github.com/repos/josh-zanecoder/josh-zanecoder/pulls?state=closed*' => Http::response([
                [
                    'state' => 'closed',
                    'title' => 'Closed PR'
                ]
            ], 200)
        ]);

        $response = $this->get('/api/pulls?state=closed');

        $response->assertStatus(200)
                ->assertJsonFragment(['state' => 'closed']);
    }
}
