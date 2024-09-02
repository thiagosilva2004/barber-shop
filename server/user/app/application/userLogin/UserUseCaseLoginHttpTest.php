<?php

namespace app\application\userLogin;

use app\domain\user\valueObject\password\Password;
use app\infrastructure\database\Models\User as UserModel;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class UserUseCaseLoginHttpTest extends TestCase
{
    private string $uri = "/api/v1/login";
    private static string $user_id = "e72f32c5-c432-4f9d-83a8-52e734699982";
    private static string $user_name = "Thiago";
    private static string $user_email = "silvahenriquethiago99@gmail.com";
    private static string $user_password = "Teste#123";
    private static ?string $user_code_verification = null;

    use RefreshDatabase;

    public function testShouldReturningStatus200():void
    {
        $this->saveUserExempleInDatabase(new DateTime(),self::$user_code_verification);

        $response = $this->postJson($this->uri, [
           "email" => self::$user_email,
           "password" => self::$user_password
        ]);

        $response->assertStatus(200);
    }

    public function testShouldReturningToken():void
    {
        $this->saveUserExempleInDatabase(new DateTime(),self::$user_code_verification);

        $response = $this->postJson($this->uri, [
            "email" => self::$user_email,
            "password" => self::$user_password
        ]);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('token')
        );
    }

    public function testShouldReturningStatus404WhenEmailNotFound():void
    {
        $this->saveUserExempleInDatabase(new DateTime(),self::$user_code_verification);

        $response = $this->postJson($this->uri, [
            "email" => "silvahenriquethiago88@gmail.com",
            "password" => self::$user_password
        ]);

        $response->assertStatus(404);
    }

    public function testShouldReturningStatus400WhenEmailIsInvalid():void
    {
        $this->saveUserExempleInDatabase(new DateTime(),self::$user_code_verification);

        $response = $this->postJson($this->uri, [
            "email" => "silvahenriquethiago",
            "password" => self::$user_password
        ]);

        $response->assertStatus(400);
    }

    public function testShouldReturningStatus400WhenEmailNotVerify():void
    {
        $this->saveUserExempleInDatabase(null,"245687");

        $response = $this->postJson($this->uri, [
            "email" => "silvahenriquethiago",
            "password" => self::$user_password
        ]);

        $response->assertStatus(400);
    }

    private function saveUserExempleInDatabase(?DateTime $email_verified_at,
        ?string $email_code_verification):void
    {
        $userModel = new UserModel();
        $userModel->id = self::$user_id;
        $userModel->name = self::$user_name;
        $userModel->email = self::$user_email;
        $userModel->email_verified_at = $email_verified_at;
        $userModel->created_at = new DateTime();
        $userModel->email_code_verification = $email_code_verification;
        $userModel->password = Password::create(
            self::$user_password, $userModel->created_at, false
        )->getValue();
        $userModel->save();
    }
}
