<?php

namespace App\EventListeners;

use App\Events\Domain\UserCreated;
use App\Events\External\UserCreated as ExternalUserCreated;
use App\Services\ExternalEventService;

class UserEventListener extends Listener implements DomainEventListenerContract
{
    private $service;

    protected static $events = [
        UserCreated::class
    ];

    public function __construct(ExternalEventService $service)
    {
        $this->service = $service;
    }

    public function onUserCreated(UserCreated $event): void
    {
        // TODO: Domain related stuff


        $this->service->dispatchEvent(
            ExternalUserCreated::from(
                $event->getUser()
            )
        );
    }
}