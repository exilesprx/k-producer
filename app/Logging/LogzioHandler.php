<?php

namespace App\Logging;

use App\ValueObjects\Logzio\LogzioToken;
use App\ValueObjects\Logzio\LogzioType;
use GuzzleHttp\Client;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class LogzioHandler extends AbstractProcessingHandler
{
    private $client;

    private $token;

    private $type;

    public function __construct(Client $client, LogzioToken $token, LogzioType $type, int $level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);

        $this->client = $client;

        $this->token = $token;

        $this->type = $type;
    }

    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function write(array $record): void
    {
        $body = $record['formatted'];

        $this->client->request('POST', '', [
           'query' => [
               'token' => (string)$this->token,
               'type' => (string)$this->type
           ],
           'body' => $body
        ]);
    }
}