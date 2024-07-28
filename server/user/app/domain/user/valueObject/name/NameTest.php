<?php

namespace app\domain\user\valueObject\name;

use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function testShouldReturnExceptionWhenNameIsEmpty(): void
    {
        $this->expectException(NameInvalidException::class);
        Name::create('');
    }

    public function testShouldReturnExceptionWhenNameIsShorter(): void
    {
        $this->expectException(NameInvalidException::class);
        Name::create('na');
    }

    public function testShouldReturnExceptionWhenNameIsLonger(): void
    {
        $this->expectException(NameInvalidException::class);
        Name::create('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent non commodo sem. Suspendisse dignissim sapien turpis, et lacinia massa euismod quis. In felis turpis, mollis at diam vel, molestie sit.');
    }

    public function testShouldReturnNameWhenIsValid(): void
    {
        $name = Name::create('Thiago Silva');
        $this->assertEquals('Thiago Silva', $name->getValue());
    }
}
