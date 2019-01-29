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
            $className = explode('\\', $event);

            $className = last($className);

            $this->listenOn($events, $className);
        }
    }

    protected function listenOn(Dispatcher $events, string $className) : void
    {
        $contextClass = static::class;

        $listenMethod = static::$postfix . $className;

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
            $className,
            $contextListener
        );
    }
}