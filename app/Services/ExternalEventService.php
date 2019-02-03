<?php

namespace App\Services;

use App\Events\External\ExternalContract;
use Illuminate\Events\Dispatcher;

class ExternalEventService
{
    private $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function dispatchEvent(ExternalContract $event)
    {
        $this->dispatcher->dispatch($event);
    }
}