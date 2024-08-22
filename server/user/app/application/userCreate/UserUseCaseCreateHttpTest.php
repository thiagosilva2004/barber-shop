<?php

namespace app\application\userCreate;

use app\domain\user\valueObject\uuid\Uuid;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
class UserUseCaseCreateHttpTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldReturningStatus200WhenUserCreate():void
    {
        $response = $this->postJson('/user', [
            'name' => 'thiago',
            'email' => 'silvahenriquethiago99@gmail.com',
            'password' => 'Teste#123'
            ]);

        $response->assertStatus(200);
    }

    public function testShouldReturningUuidWhenUserCreate():void
    {
        $response = $this->postJson('/user', [
            'name' => 'thiago',
            'email' => 'silvahenriquethiago99@gmail.com',
            'password' => 'Teste#123'
        ]);

        $user_id = $response->json('user_id');
        $this->assertIsObject(Uuid::create($user_id));
    }
}
