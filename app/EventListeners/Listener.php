<?php

namespace App\EventListeners;

use Illuminate\Contracts\Events\Dispatcher;

abstract class Listener
{
    protected static $separator = "@";

    protected static $events = [];

    protected static $postfix = "on";

    public function subscribe(Dispatcher $events)
    {
        foreach(static::$events as $event) {
            $this->listenOn($events, $event);
        }
    }

    protected function listenOn(Dispatcher $events, string $event): void
    {
        $contextClass = static::class;

        $className = explode('\\', $event);

        $listenMethod = static::$postfix . last($className);

        $contextListener = implode(
            "",
            [
                $contextClass,
                static::$separator,
                $listenMethod
            ]
        );

        if (! method_exists($this, $listenMethod)) {
            throw new \Exception("Method {$contextListener} does not exist.");
        }

        $events->listen(
            $event,
            $contextListener
        );
    }
}