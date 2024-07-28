<?php

namespace app\domain\user\valueObject\codeVerification;

use PHPUnit\Framework\TestCase;

class CodeVerificationTest extends TestCase
{
    public function testShouldGenerateCodeWithSixLetter(): void
    {
        $code = CodeVerification::generate();
        $this->assertSame(strlen($code->getValue()), 6);
    }

    public function testShouldGenerateCodeNumeric(): void
    {
        $code = CodeVerification::generate();
        $this->assertIsNumeric($code->getValue());
    }

    public function testShouldReturningExceptionWhenCodeIsLessThanSixLetter(): void
    {
        $this->expectException(CodeVerificationInvalidException::class);
        CodeVerification::create('744');
    }

    public function testShouldReturningExceptionWhenCodeIsMoreThanSixLetter(): void
    {
        $this->expectException(CodeVerificationInvalidException::class);
        CodeVerification::create('7444545454');
    }

    public function testShouldReturningExceptionWhenCodeIsNotNumeric(): void
    {
        $this->expectException(CodeVerificationInvalidException::class);
        CodeVerification::create('dad45b');
    }
}
