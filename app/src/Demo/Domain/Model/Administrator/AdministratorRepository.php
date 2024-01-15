<?php

namespace Demo\Domain\Model\Administrator;

use Demo\Domain\Model\Administrator\AdministratorDto;
use Demo\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Core\Domain\Service\Repository\RepositoryInterface;

/**
 * @extends RepositoryInterface<AdministratorInterface, AdministratorDto>
 */
interface AdministratorRepository extends RepositoryInterface
{
    public function findByUsername(string $username): ?AdministratorInterface;
}
