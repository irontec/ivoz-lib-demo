<?php

namespace Demo\Domain\Model\Platform;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

/**
 * @extends Selectable<int,Platform>
 * @extends ObjectRepository<Platform>
 */
interface PlatformRepository extends Selectable, ObjectRepository {
}
