<?php

namespace app\application\userCreate;

use app\domain\user\events\created\UserCreatedDispatcher;
use app\domain\user\exception\EmailAlreadyCreateException;
use app\domain\user\repository\UserRepository;
use Illuminate\Foundation\Testing\TestCase;

class UserUseCaseCreateTest extends TestCase
{

    public function testShouldReturningExceptionWhenEmailAlreadyCreated(): void
    {
        $this->expectException(EmailAlreadyCreateException::class);

        $repository = $this->getMockBuilder(UserRepository::class)->getMock();
        $repository->expects($this->once())->method('existWithEmail')->willReturn(true);
        $dispatcher = $this->getMockBuilder(UserCreatedDispatcher::class)
            ->disableOriginalConstructor()->getMock();

        $userUseCase = new UserUseCaseCreate($repository, $dispatcher);
        $userUseCase->execute(
            new UserUseCaseCreateDtoInput(
                'teste@gmail.com',
                'generic name',
                'Str0ng!P@ssw0rd'
            )
        );
    }

    public function testShouldReturningUserID(): void
    {
        $repository = $this->getMockBuilder(UserRepository::class)->getMock();
        $repository->expects($this->once())->method('existWithEmail')->willReturn(false);
        $dispatcher = $this->getMockBuilder(UserCreatedDispatcher::class)
            ->disableOriginalConstructor()->getMock();

        $userUseCase = new UserUseCaseCreate($repository, $dispatcher);
        $output = $userUseCase->execute(
            new UserUseCaseCreateDtoInput(
                'teste@gmail.com',
                'generic name',
                'Str0ng!P@ssw0rd'
            )
        );

        $this->assertNotEmpty($output->user_id);
    }
}
