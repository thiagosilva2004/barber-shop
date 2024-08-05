<?php

namespace app\domain\user\events\created;

use app\domain\user\User;

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

        foreach ($this->eventHandlers as $eventHandler) {
            $eventHandler->handler->execute($event);
        }
    }
}
