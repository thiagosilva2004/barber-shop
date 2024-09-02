<?php

namespace app\domain\user\valueObject\email;

use Illuminate\Foundation\Testing\TestCase;

class EmailTest extends TestCase
{
    public function testShouldReturnExceptionWhenEmailIsEmpty(): void
    {
        $this->expectException(EmailInvalidException::class);
        Email::create('');
    }

    public function testShouldReturnExceptionWhenEmailIsInvalid(): void
    {
        $this->expectException(EmailInvalidException::class);
        Email::create('exemplo@dominio');
    }

    public function testShouldReturnEmailWhenIsValid(): void
    {
        $email = Email::create('exemplo@dominio.com');
        $this->assertEquals('exemplo@dominio.com', $email->getValue());
    }
}
