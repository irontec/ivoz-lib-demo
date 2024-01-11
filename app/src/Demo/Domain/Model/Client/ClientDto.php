<?php

namespace Demo\Domain\Model\Client;

class ClientDto extends ClientDtoAbstract
{
    /** @var string[]  */
    protected $sensitiveFields = [
        'domain'
    ];

}
