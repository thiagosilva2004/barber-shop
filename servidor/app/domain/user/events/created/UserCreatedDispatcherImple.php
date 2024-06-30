<?php

namespace App\domain\user\events\created;

use App\domain\user\User;

class UserCreatedDispatcherImple implements UserCreatedDispatcher
{
    /**
     * @var array<UserCreatedHandleItem>
     */
    private array $eventHandlers = array();

    public function register(string $eventName, UserCreatedHandler $handler): void
    {
        $item = new UserCreatedHandleItem($handler, $eventName);
        $this->eventHandlers[] = $item;
    }

    public function notify(User $user): void
    {
        $event = new UserCreatedEvent(
            dateTimeOccurred: $user->getCreatedAt(),
            name: $user->getName()->getValue(),
            email: $user->getEmail()->getValue(),
            emailCodeVerification: $user->getCodeVerification()?->getValue()
        );

        foreach ($this->eventHandlers as $eventHandler){
            $eventHandler->handler->execute($event);
        }
    }
}

class UserCreatedHandleItem
{
    public function __construct(
        public UserCreatedHandler $handler,
        public string $eventName
    ){}
}
