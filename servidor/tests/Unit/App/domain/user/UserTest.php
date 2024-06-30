<?php

namespace App\domain\user;

use App\domain\user\exception\EmailNotVerifyException;
use App\domain\user\exception\LoginInvalidException;
use App\domain\user\exception\UserCodeVerificationIsDifferent;
use App\domain\user\exception\UserEmailAlreadyVerify;
use App\domain\user\valueObject\codeVerification\CodeVerification;
use App\domain\user\valueObject\email\Email;
use App\domain\user\valueObject\name\Name;
use App\domain\user\valueObject\password\Password;
use App\domain\user\valueObject\uuid\Uuid;
use DateTime;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testShouldReturningExceptionWhenVerifyEmailWithEmailAlreadyVerified():void
    {
        $this->expectException(UserEmailAlreadyVerify::class);
        $user = new User(
            id: Uuid::create('e72f32c5-c432-4f9d-83a8-52e734699982'),
            name: Name::create('fulano'),
            email: Email::create('teste@gmail.com'),
            password: Password::create('Teste#123',New DateTime(),false),
            email_verified_at: New DateTime(),
            codeVerification: CodeVerification::create('492037'),
            created_at: New DateTime()
        );
        $user->verifyEmail('492037');
    }

    public function testShouldReturningExceptionWhenCodeVerificationEmailIsDifferent():void
    {
        $this->expectException(UserCodeVerificationIsDifferent::class);
        $user = new User(
            id: Uuid::create('e72f32c5-c432-4f9d-83a8-52e734699982'),
            name: Name::create('fulano'),
            email: Email::create('teste@gmail.com'),
            password: Password::create('Teste#123',New DateTime(),false),
            email_verified_at: null,
            codeVerification: CodeVerification::create('492037'),
            created_at: New DateTime()
        );
        $user->verifyEmail('492038');
    }

    public function testShouldReturningSuccessWhenCodeVerificationIsEquals():void
    {
        $user = new User(
            id: Uuid::create('e72f32c5-c432-4f9d-83a8-52e734699982'),
            name: Name::create('fulano'),
            email: Email::create('teste@gmail.com'),
            password: Password::create('Teste#123',New DateTime(),false),
            email_verified_at: null,
            codeVerification: CodeVerification::create('492037'),
            created_at: New DateTime()
        );
        $user->verifyEmail('492037');
        $this->assertNull($user->getCodeVerification());
        $this->assertNotNull($user->getEmailVerifiedAt());
    }

    public function testShouldReturningExceptionWhenLoginAndEmailNotVerified():void
    {
        $this->expectException(EmailNotVerifyException::class);
        $user = new User(
            id: Uuid::create('e72f32c5-c432-4f9d-83a8-52e734699982'),
            name: Name::create('fulano'),
            email: Email::create('teste@gmail.com'),
            password: Password::create('Teste#123',New DateTime(),false),
            email_verified_at: null,
            codeVerification: CodeVerification::create('492037'),
            created_at: New DateTime()
        );
        $user->login('Teste#123');
    }

    public function testShouldReturningExceptionWhenLoginAndPasswordIsDifferent():void
    {
        $this->expectException(LoginInvalidException::class);
        $user = new User(
            id: Uuid::create('e72f32c5-c432-4f9d-83a8-52e734699982'),
            name: Name::create('fulano'),
            email: Email::create('teste@gmail.com'),
            password: Password::create('Teste#123',New DateTime(),false),
            email_verified_at: New DateTime(),
            codeVerification: CodeVerification::create('492037'),
            created_at: New DateTime()
        );
        $user->login('Teste#12345');
    }

    public function testShouldReturningSuccessWhenLoginAndPasswordIsEquals():void
    {
        $password = Password::create('Teste#123', New DateTime(), false);

        $user = new User(
            id: Uuid::create('e72f32c5-c432-4f9d-83a8-52e734699982'),
            name: Name::create('fulano'),
            email: Email::create('teste@gmail.com'),
            password: $password,
            email_verified_at: New DateTime(),
            codeVerification: CodeVerification::create('492037'),
            created_at: New DateTime()
        );
        $user->login('Teste#123');
        $this->assertSame($password, $user->getPassword());
    }
}
