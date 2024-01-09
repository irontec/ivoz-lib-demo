<?php

namespace Demo\Infrastructure\Api\Security\Administrator;

use Demo\Domain\Model\Administrator\Administrator;
use Doctrine\Persistence\ManagerRegistry;
use Demo\Domain\Model\Administrator\AdministratorInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

trait AdministratorProviderTrait
{
    public function __construct(
        private ManagerRegistry $registry,
        private RequestStack $requestStack,
        private LoggerInterface $logger,
        private string $entityClass,
        private ?string $managerName = null
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername(string $username)
    {
        try {
            /** @var ?Administrator $user */
            $user = $this->findUser($username);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw $e;
        }

        if (null === $user) {
            $errorMsg = sprintf('Admin "%s" not found.', $username);
            $this->logger->debug($errorMsg);
            throw new UsernameNotFoundException($errorMsg);
        }

        return $user;
    }

    abstract protected function findUser(string $identity): ?AdministratorInterface;

    /**
     * {@inheritdoc}
     */
    public function refreshUser(SymfonyUserInterface $user)
    {
        if (!$user instanceof $this->entityClass) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $repository = $this->getRepository();

        // The user must be reloaded via the primary key as all other data
        // might have changed without proper persistence in the database.
        // That's the case when the user has been changed by a form with
        // validation errors.
        if (!$id = $this->getClassMetadata()->getIdentifierValues($user)) {
            throw new \InvalidArgumentException('You cannot refresh a user ' .
                'from the EntityUserProvider that does not contain an identifier. ' .
                'The user object has to be serialized with its own identifier ' .
                'mapped by Doctrine.');
        }

        $refreshedUser = $repository->find($id);
        if (null === $refreshedUser) {
            throw new UsernameNotFoundException(sprintf('User with id %s not found', json_encode($id, JSON_THROW_ON_ERROR)));
        }

        return $refreshedUser;
    }

    /**
     * @return \Doctrine\Persistence\ObjectManager
     */
    private function getObjectManager()
    {
        return $this->registry->getManager(
            $this->managerName
        );
    }

    /**
     * @return \Doctrine\Persistence\ObjectRepository
     */
    private function getRepository()
    {
        return $this->getObjectManager()->getRepository(
            $this->entityClass
        );
    }

    /**
     * @return \Doctrine\Persistence\Mapping\ClassMetadata
     */
    private function getClassMetadata()
    {
        return $this->getObjectManager()->getClassMetadata(
            $this->entityClass
        );
    }
}
