<?php

namespace Demo\Domain\Model\Platform;

use Demo\Domain\Model\Platform\PlatformDto;
use Demo\Domain\Model\Platform\PlatformInterface;
use Ivoz\Core\Domain\Service\Repository\RepositoryInterface;

/**
 * extends RepositoryInterface<PlatformInterface, PlatformDto>
 */
interface PlatformRepository extends RepositoryInterface
{
}
