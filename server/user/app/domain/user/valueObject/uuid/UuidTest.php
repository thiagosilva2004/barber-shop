<?php

namespace app\domain\user\valueObject\uuid;

use Illuminate\Foundation\Testing\TestCase;

class UuidTest extends TestCase
{
    public function testShouldExceptionWhenUuidIsInvalid(): void
    {
        $this->expectException(UuidInvalidException::class);
        Uuid::create('298a4015-6a1f-4d19-81ce-fa1ce8dc7f');
    }

    public function testShouldGenerateWhenUuidIsEmpty(): void
    {
        $uuid = Uuid::create('');
        $this->assertNotEmpty($uuid->getValue());
    }

    public function testShouldReturingSameValueWhenUuidIsValid(): void
    {
        $uuidValid = '298a4015-6a1f-4d19-81ce-fa1ce8dc7fe9';
        $uuid = Uuid::create($uuidValid);
        $this->assertEquals($uuidValid, $uuid->getValue());
    }
}
