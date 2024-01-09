<?php

namespace App\Service;

use Demo\Domain\Model\Administrator\Administrator;
use Demo\Domain\Model\Administrator\AdministratorInterface;
use Demo\Domain\Model\Administrator\AdministratorRepository;
use Demo\Infrastructure\Api\Security\Administrator\AdministratorProviderTrait;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AdministratorProvider implements UserProviderInterface
{
    use AdministratorProviderTrait;

    protected function findUser(string $identity): ?AdministratorInterface
    {
        /** @var AdministratorRepository $repository */
        $repository = $this->getRepository();

        return $repository->findByUsername($identity);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass(string $class)
    {
        $isAdmin =
            $class === Administrator::class
            || is_subclass_of($class, Administrator::class);

        return $isAdmin;
    }
}
