<?php

namespace Tests\Feature;

use Tests\TestCase;

class PullRequestsViewTest extends TestCase
{
    /** @test */
    public function it_can_load_pull_requests_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200)
                ->assertViewIs('index')
                ->assertSee('Pull requests')
                ->assertSee('Open')
                ->assertSee('Closed');
    }
} 