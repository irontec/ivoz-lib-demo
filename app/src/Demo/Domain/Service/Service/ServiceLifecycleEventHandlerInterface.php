<?php

namespace Demo\Domain\Service\Service;

use Demo\Domain\Model\Service\ServiceInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface ServiceLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(ServiceInterface $service): void;
}