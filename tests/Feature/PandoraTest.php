<?php

namespace Tests\Feature;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class PandoraTest extends TestCase
{
    private $routes;

    public function setUp(): void
    {
        parent::setUp();
        $this->routes = [
            '/' => '/'
        ];
    }
    /**
     * Home page return success.
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->json('GET', $this->routes['/'])
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'status',
                'laravel_version',
                'php_version',
                'pandora_version'
            ])
            ->assertJson([
                'status' => 'ok',
                'laravel_version' => Application::VERSION,
                'php_version' => PHP_VERSION,
                'pandora_version' => config('pandora.version')
            ]);
    }
}
