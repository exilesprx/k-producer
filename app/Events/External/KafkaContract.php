<?php

namespace App\Events\External;

interface KafkaContract extends ExternalContract
{
    public function getName() : string;
}