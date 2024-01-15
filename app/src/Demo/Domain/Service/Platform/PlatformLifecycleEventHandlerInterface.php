<?php

namespace Demo\Domain\Service\Platform;

use Demo\Domain\Model\Platform\PlatformInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface PlatformLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(PlatformInterface $platform): void;
}
