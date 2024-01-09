<?php

namespace Demo\Domain\Model\Administrator;

use Symfony\Component\Security\Core\User\LegacyPasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Administrator
 */
class Administrator extends AdministratorAbstract implements AdministratorInterface, UserInterface, LegacyPasswordAuthenticatedUserInterface
{
    use AdministratorTrait;

    /**
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): null|int
    {
        return $this->id;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return ['ROLE_ADMIN'];
    }

    public function getPassword(): ?string
    {
        return $this->getPass();
    }

    /**
     * @see UserInterface::getSalt()
     */
    public function getSalt(): ?string
    {
        return substr(
            (string) $this->getPassword(),
            0,
            29
        );
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials(): void
    {
    }

    /**
     * @throws \Exception
     */
    protected function setPass(string $pass): static
    {
        if (
            $this->isInitialized()
            && $pass === $this->getPass()
        ) {
            return $this;
        }
        $pass = trim($pass);
        $salt = substr(md5((string)random_int(0, mt_getrandmax()), false), 0, 22);
        $cryptPass = crypt(
            $pass,
            '$2a$08$' . $salt . '$' . $salt . '$'
        );

        return parent::setPass($cryptPass);
    }
}
