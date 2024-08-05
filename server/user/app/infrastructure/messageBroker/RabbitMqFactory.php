<?php

namespace app\infrastructure\messageBroker;

class RabbitMqFactory
{
    public static function create():MessageBroker
    {
        return new RabbitMq(
            host: $_ENV['RABBITMQ_HOST'],
            port: $_ENV['RABBITMQ_PORT'],
            user: $_ENV['RABBITMQ_USER'],
            password: $_ENV['RABBITMQ_PASSWORD']
        );
    }
}
