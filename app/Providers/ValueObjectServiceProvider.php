<?php

namespace App\Providers;

use App\ValueObjects\ApplicationQueue;
use Illuminate\Support\ServiceProvider;

class ValueObjectServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ApplicationQueue::class,
            function() {
                $name = env("KAFKA_QUEUE");

                return new ApplicationQueue($name);
            }
        );
    }
}