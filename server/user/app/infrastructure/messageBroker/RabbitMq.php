<?php

namespace app\infrastructure\messageBroker;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMq implements MessageBroker
{
    private ?AMQPStreamConnection $connection = null;
    private ?AMQPChannel $channel = null;

    public function __construct(
        private readonly string $host,
        private readonly int $port,
        private readonly string $user,
        private readonly string $password
    )
    {

    }

    public function publish(mixed $data, Queue $queue,RoutingKey $routingKey): void
    {
        try {
            $this->connect();
            $message = new AMQPMessage(json_encode($data));
            $this->channel->basic_publish(
                $message,
                $this->queueToString($queue),
                $this->routingKeyToString($routingKey));
        } finally {
            $this->closeConnection();
        }
    }

    public function connect():void
    {
        $this->connection = new AMQPStreamConnection(
            host: $this->host,
            port: $this->port,
            user: $this->user,
            password: $this->password
        );
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare(
            $this->queueToString(Queue::EMAIL),
            durable: true,
            auto_delete: false
        );
    }

    public function closeConnection():void
    {
        $this->channel?->close();
        $this->connection?->close();

        $this->channel = null;
        $this->connection = null;
    }

    public function queueToString(Queue $queue):string
    {
        return match ($queue){
            Queue::EMAIL => "email",
        };
    }

    public function routingKeyToString(RoutingKey $routingKey):string
    {
        return match ($routingKey){
            RoutingKey::EMAIL => "email",
        };
    }
}
