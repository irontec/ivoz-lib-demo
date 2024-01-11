<?php

namespace Demo\Domain\Model\Client;

use Demo\Domain\Model\Platform\Platform;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Core\Domain\Service\Repository\RepositoryInterface;

/**
 * @extends Selectable<int,Client>
 * @extends ObjectRepository<Client>
 */
interface ClientRepository extends Selectable, ObjectRepository
{
}
