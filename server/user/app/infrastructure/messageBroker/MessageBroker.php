<?php

namespace app\infrastructure\messageBroker;

interface MessageBroker
{
    public function publish(mixed $data, Queue $queue, RoutingKey $routingKey):void;
}
