<?php

namespace Demo\Domain\Service\Client;

use Demo\Domain\Model\Client\ClientInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface ClientLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(ClientInterface $Client): void;
}
