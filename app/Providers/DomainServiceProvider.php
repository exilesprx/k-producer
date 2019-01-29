<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Interop\Queue\ConnectionFactory;

class DomainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ConnectionFactory::class,
            function() {

                $host = env("KAFKA_HOST");

                $port = env("KAFKA_PORT");

                $reset = env("KAFKA_OFFSET_RESET");

                return new \Enqueue\RdKafka\RdKafkaConnectionFactory([
                    'global' => [
                        'group.id' => uniqid('', true),
                        'metadata.broker.list' => "{$host}:{$port}",
                        'enable.auto.commit' => 'false',
                    ],
                    'topic' => [
                        'auto.offset.reset' => $reset,
                    ],
                ]);
            }
        );
    }
}