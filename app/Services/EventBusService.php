<?php

namespace App\Services;

use App\Events\Domain\DomainContract;
use Illuminate\Events\Dispatcher;

class EventBusService
{
    private $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function dispatchEvent(DomainContract $event)
    {
        $this->dispatcher->dispatch($event);
    }
}