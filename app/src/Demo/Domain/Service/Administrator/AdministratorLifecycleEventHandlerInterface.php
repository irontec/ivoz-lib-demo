<?php

namespace Demo\Domain\Service\Administrator;

use Demo\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface AdministratorLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(AdministratorInterface $administrator): void;
}
