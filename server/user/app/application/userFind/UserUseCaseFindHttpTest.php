<?php

namespace app\application\userFind;

use app\infrastructure\database\Models\User as UserModel;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class UserUseCaseFindHttpTest extends TestCase
{
    private string $uri = "/api/v1/user/";
    private static string $user_id = "e72f32c5-c432-4f9d-83a8-52e734699982";
    private static string $user_name = "Thiago";
    private static string $user_email = "silvahenriquethiago99@gmail.com";
    private static string $user_password = "dsbdsjbdjsnjdns";
    private static string $user_code_verification = "011217";

    use RefreshDatabase;

    public function testShouldReturningStatus200WhenUserExist():void
    {
        $this->saveUserExempleInDatabase();

        $response = $this->get($this->uri . self::$user_id);
        $response->assertStatus(200);
    }

    public function testShouldRetuningEmailWhenUserExist():void
    {
        $this->saveUserExempleInDatabase();

        $response = $this->get($this->uri . self::$user_id);
        $this->assertEquals(self::$user_email, $response->json('email'));
    }

    public function testShouldRetuningNameWhenUserExist():void
    {
        $this->saveUserExempleInDatabase();

        $response = $this->get($this->uri . self::$user_id);
        $this->assertEquals(self::$user_name, $response->json('name'));
    }

    public function testShouldReturningStatus404WhenUserNotExist():void
    {
        $this->saveUserExempleInDatabase();

        $response = $this->get($this->uri . "94bea39c-ad89-421e-8d88-e8d38c925b72");
        $response->assertStatus(404);
    }

    public function testShouldReturningStatus400WhenUserIDIsNotValid():void
    {
        $this->saveUserExempleInDatabase();

        $response = $this->get($this->uri . "121");
        $response->assertStatus(400);
    }

    private function saveUserExempleInDatabase():void
    {
        $userModel = new UserModel();
        $userModel->id = self::$user_id;
        $userModel->name = self::$user_name;
        $userModel->email = self::$user_email;
        $userModel->password = self::$user_password;
        $userModel->email_verified_at = null;
        $userModel->created_at = new DateTime();
        $userModel->email_code_verification = self::$user_code_verification;
        $userModel->save();
    }

}
