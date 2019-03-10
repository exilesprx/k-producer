<?php

namespace App\EventListeners;

use App\Events\External\KafkaContract;
use Interop\Queue\ConnectionFactory;
use Interop\Queue\Context;
use Interop\Queue\Message;
use Ramsey\Uuid\Uuid;

abstract class ExternalEventListener extends Listener implements ExternalEventListenerContract
{
    protected $factory;

    protected $queue;

    public function __construct(ConnectionFactory $factory)
    {
        $this->factory = $factory;
    }

    protected function sendMessage(KafkaContract $event): void
    {
        $context = $this->createContext();

        $message = $this->createMessage($context, $event);

        $queue = $context->createQueue($this->queue);

        $context->createProducer()->send($queue, $message);
    }

    private function createContext(): Context
    {
        return $this->factory->createContext();
    }

    private function createMessage(Context $context, KafkaContract $event): Message
    {
        $data = $event->toArray();

        array_add($data, 'uuid', Uuid::uuid4());

        return $context->createMessage($event->getName(), $data);
    }
}