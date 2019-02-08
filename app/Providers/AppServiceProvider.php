<?php

namespace App\Providers;

use App\Logging\LogzioHandler;
use App\ValueObjects\Logzio\LogzioToken;
use App\ValueObjects\Logzio\LogzioType;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            LogzioToken::class,
            function() {
                return new LogzioToken(env("LOGZIO_TOKEN"));
            }
        );

        $this->app->bind(
            LogzioType::class,
            function() {
                return new LogzioType(env("LOGZIO_TYPE"));
            }
        );

        $this->app->when(LogzioHandler::class)
            ->needs(Client::class)
            ->give(function() {

                $host = env('LOGZIO_HOST');

                $port = env('LOGZIO_PORT');

                $baseUri = "http://{$host}:{$port}";

                return new Client(
                    [
                        'base_uri' => $baseUri
                    ]
                );
            });
    }
}
