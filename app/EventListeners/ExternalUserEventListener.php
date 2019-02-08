<?php

namespace App\EventListeners;

use App\Events\External\UserCreated;
use App\ValueObjects\UserCreatedQueue;
use Interop\Queue\ConnectionFactory;
use Psr\Log\LoggerInterface;

class ExternalUserEventListener extends ExternalEventListener
{
    private $logger;

    protected static $events = [
        UserCreated::class
    ];

    public function __construct(ConnectionFactory $factory, UserCreatedQueue $queue, LoggerInterface $logger)
    {
        parent::__construct($factory);

        $this->queue = $queue;

        $this->logger = $logger;
    }

    public function onUserCreated(UserCreated $event): void
    {
        $this->logger->info($event);

        $this->sendMessage($event);
    }
}