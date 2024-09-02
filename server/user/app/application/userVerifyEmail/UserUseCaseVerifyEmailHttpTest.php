<?php

namespace app\application\userVerifyEmail;

use app\infrastructure\database\Models\User as UserModel;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class UserUseCaseVerifyEmailHttpTest extends TestCase
{
    private string $uri = "/api/v1/user/email_verify";
    private static string $user_id = "e72f32c5-c432-4f9d-83a8-52e734699982";
    private static string $user_name = "Thiago";
    private static string $user_email = "silvahenriquethiago99@gmail.com";
    private static string $user_password = "dsbdsjbdjsnjdns";
    private static string $user_code_verification = "011217";

    use RefreshDatabase;

    public function testShouldReturningStatus200():void
    {
        $this->saveUserExempleInDatabase();

        $response = $this->postJson($this->uri,[
            "user_id" => self::$user_id,
            'code' => self::$user_code_verification,
        ]);
        $response->assertStatus(200);
    }

    public function testShouldReturningStatus400WhenCodeIsInvalid():void
    {
        $this->saveUserExempleInDatabase();

        $response = $this->postJson($this->uri,[
            "user_id" => self::$user_id,
            'code' => '454'
        ]);
        $response->assertStatus(400);
    }

    public function testShouldReturningStatus400WhenCodeIsDifferent():void
    {
        $this->saveUserExempleInDatabase();

        $response = $this->postJson($this->uri,[
            "user_id" => self::$user_id,
            'code' => '784569'
        ]);
        $response->assertStatus(400);
    }

    public function testShouldReturningStatus404WhenUserNotFound():void
    {
        $this->saveUserExempleInDatabase();

        $response = $this->postJson($this->uri,[
            "user_id" => "94bea39c-ad89-421e-8d88-e8d38c925b72",
            'code' => self::$user_code_verification
        ]);
        $response->assertStatus(404);
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
