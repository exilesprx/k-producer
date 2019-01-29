<?php

namespace App\EventListeners;

use Illuminate\Contracts\Events\Dispatcher;

interface DomainEventListenerContract
{
    public function subscribe(Dispatcher $events);
}