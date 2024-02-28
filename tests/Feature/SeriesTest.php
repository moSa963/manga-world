<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SeriesTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_page_can_be_rendered(): void
    {
        $response = $this->get('/series');

        $response->assertStatus(200);
    }
}
