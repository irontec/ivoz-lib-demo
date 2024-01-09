<?php

namespace Demo\Domain\Model\Administrator;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

/**
 * @extends Selectable<int,Administrator>
 * @extends ObjectRepository<Administrator>
 */
interface AdministratorRepository extends ObjectRepository, Selectable
{
    public function findByUsername(string $username): ?AdministratorInterface;
}
