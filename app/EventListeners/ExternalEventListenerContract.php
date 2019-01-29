<?php

namespace App\EventListeners;

use Illuminate\Contracts\Events\Dispatcher;

interface ExternalEventListenerContract
{
    public function subscribe(Dispatcher $events);
}