<?php

namespace app\application\userCreate;

use app\domain\user\valueObject\uuid\Uuid;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
class UserUseCaseCreateHttpTest extends TestCase
{
    private string $uri = "/api/v1/user";

    use RefreshDatabase;

    public function testShouldReturningStatus200WhenUserCreate():void
    {
        $response = $this->postJson($this->uri, [
            'name' => 'thiago',
            'email' => 'silvahenriquethiago99@gmail.com',
            'password' => 'Teste#123'
            ]);

        $response->assertStatus(200);
    }

    public function testShouldReturningValidUuidWhenUserCreate():void
    {
        $response = $this->postJson($this->uri, [
            'name' => 'thiago',
            'email' => 'silvahenriquethiago99@gmail.com',
            'password' => 'Teste#123'
        ]);

        $user_id = $response->json('user_id');
        $this->assertIsObject(Uuid::create($user_id));
    }

    public function testShouldSaveUserInDatabase():void
    {
        $this->postJson($this->uri, [
            'name' => 'thiago',
            'email' => 'silvahenriquethiago99@gmail.com',
            'password' => 'Teste#123'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'silvahenriquethiago99@gmail.com',
            'name' => 'thiago'
        ]);
    }

    public function testShouldReturningErrorWhenNameIsInvalid():void
    {
        $response = $this->postJson($this->uri, [
            'name' => 'th',
            'email' => 'silvahenriquethiago99@gmail.com',
            'password' => 'Teste#123'
        ]);

        $response->assertStatus(400);
    }

    public function testShouldReturningErrorWhenEmailIsInvalid():void
    {
        $response = $this->postJson($this->uri, [
            'name' => 'thiago',
            'email' => 'silvahenriquethiago9',
            'password' => 'Teste#123'
        ]);

        $response->assertStatus(400);
    }

    public function testShouldReturningErrorWhenPasswordIsInvalid():void
    {
        $response = $this->postJson($this->uri, [
            'name' => 'thiago',
            'email' => 'silvahenriquethiago99@gmail.com',
            'password' => 'Teste'
        ]);

        $response->assertStatus(400);
    }
}
