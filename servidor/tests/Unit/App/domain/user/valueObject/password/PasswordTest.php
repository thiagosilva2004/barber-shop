<?php

namespace App\domain\user\valueObject\password;

use DateTime;
use Illuminate\Foundation\Testing\TestCase;

class PasswordTest extends TestCase
{
    public function testShouldExceptionWhenPasswordIsWeak():void
    {
        $this->expectException(PasswordInvalidException::class);
        Password::create('passwordWeak',new DateTime(),false);
    }

    public function testShouldExceptionWhenPasswordIsShort():void
    {
        $this->expectException(PasswordInvalidException::class);
        Password::create('pas',new DateTime(),false);
    }

    public function testShouldExceptionWhenPasswordWithinUppercaseLetter():void
    {
        $this->expectException(PasswordInvalidException::class);
        Password::create('pas!&bash',new DateTime(),false);
    }

    public function testShouldExceptionWhenPasswordWithinLowercaseLetter():void
    {
        $this->expectException(PasswordInvalidException::class);
        Password::create('PASS!&BASH',new DateTime(),false);
    }

    public function testShouldExceptionWhenPasswordWithinEspecialLetter():void
    {
        $this->expectException(PasswordInvalidException::class);
        Password::create('PASStimeBASH',new DateTime(),false);
    }

    public function testShouldGenerateHashWhenPasswordIsStrong():void
    {
        $password = Password::create('Str0ng!P@ssw0rd',new DateTime(),false);
        $this->assertNotEmpty($password->getValue());
    }

    public function testShouldReturnFalseWhenPasswordIsDifferent():void
    {
        $password = Password::create('Str0ng!P@ssw0rd',new DateTime(),false);
        $this->assertFalse($password->compare('Str0ng!P@ssw0r'));
    }

    public function testShouldReturnFalseWhenPasswordIsEquals():void
    {
        $password = Password::create('Str0ng!P@ssw0rd',new DateTime(),false);
        $this->assertTrue($password->compare('Str0ng!P@ssw0rd'));
    }

    public function testNotShouldChangePasswordWhenIsHashed():void
    {
        $create_at = new DateTime();
        $password = Password::create('Str0ng!P@ssw0rd',$create_at,false);
        $passwordHashed = $password->getValue();

        $passwordNew = Password::create($passwordHashed,$create_at,true);
        $this->assertEquals($passwordNew->getValue(), $passwordHashed);
    }
}
