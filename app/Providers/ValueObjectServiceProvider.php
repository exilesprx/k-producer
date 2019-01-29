<?php

namespace App\Providers;

use App\ValueObjects\UserCreatedQueue;
use Illuminate\Support\ServiceProvider;

class ValueObjectServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            UserCreatedQueue::class,
            function() {
                return new UserCreatedQueue('user.created');
            }
        );
    }
}