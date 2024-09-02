<?php

namespace app\application\userUpdate;

use app\infrastructure\database\Models\User as UserModel;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class UseUseCaseUpdateHttpTest extends TestCase
{
    private string $uri = "/api/v1/user";
    private static string $user_id = "e72f32c5-c432-4f9d-83a8-52e734699982";
    private static string $user_name = "Thiago";
    private static string $user_email = "silvahenriquethiago99@gmail.com";
    private static string $user_password = "dsbdsjbdjsnjdns";
    private static string $user_code_verification = "011217";

    use RefreshDatabase;

    public function testShouldReturningStatus400WhenUserIDIsNotValid():void
    {
        $this->saveUserExempleInDatabase();

        $response = $this->putJson($this->uri,[
            "user_id" => "545",
            'name' => 'thiago',
        ]);
        $response->assertStatus(400);
    }

    public function testShouldReturningStatus400WhenUserNameIsNotValid():void
    {
        $this->saveUserExempleInDatabase();

        $response = $this->putJson($this->uri,[
            "user_id" => self::$user_id,
            'name' => 'th',
        ]);
        $response->assertStatus(400);
    }

    public function testShouldReturningStatus404WhenUserNotExist():void
    {
        $this->saveUserExempleInDatabase();

        $response = $this->putJson($this->uri,[
            "user_id" => "94bea39c-ad89-421e-8d88-e8d38c925b72",
            'name' => 'thiago',
        ]);
        $response->assertStatus(404);
    }

    public function testShouldReturningStatus200():void
    {
        $this->saveUserExempleInDatabase();

        $response = $this->putJson($this->uri,[
            "user_id" => self::$user_id,
            'name' => 'thiago silva',
        ]);
        $response->assertStatus(200);
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
