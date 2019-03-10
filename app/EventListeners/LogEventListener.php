<?php

namespace App\EventListeners;

use App\Events\LogableEvent;
use Psr\Log\LoggerInterface;

class LogEventListener extends Listener
{
    private $logger;

    protected static $events = [
        LogableEvent::class
    ];

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onLogableEvent(LogableEvent $event)
    {
        $this->logger->info($event->toJson());
    }
}