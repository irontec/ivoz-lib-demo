<?php

namespace Demo\Domain\Model\Client;

use Demo\Domain\Model\Client\ClientDto;
use Demo\Domain\Model\Client\ClientInterface;
use Ivoz\Core\Domain\Service\Repository\RepositoryInterface;

/**
 * extends RepositoryInterface<ClientInterface, ClientDto>
 */
interface ClientRepository extends RepositoryInterface
{
    public function findByPlatformId(int $id) : ?ClientInterface;
}
