<?php

namespace App\EventListeners;

use App\Events\External\UserCreated;
use App\ValueObjects\ApplicationQueue;
use Interop\Queue\ConnectionFactory;

class ExternalUserEventListener extends ExternalEventListener
{
    protected static $events = [
        UserCreated::class
    ];

    public function __construct(ConnectionFactory $factory, ApplicationQueue $queue)
    {
        parent::__construct($factory);

        $this->queue = $queue;
    }

    public function onUserCreated(UserCreated $event): void
    {
        $this->sendMessage($event);
    }
}