<?php

namespace Demo\Domain\Model\Administrator;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Demo\Domain\Model\Timezone\TimezoneInterface;

/**
* AdministratorInterface
*/
interface AdministratorInterface extends LoggableEntityInterface
{
    /**
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): ?int;

    /**
     * @return string[]
     */
    public function getRoles(): array;

    public function getPassword(): ?string;

    /**
     * @see UserInterface::getSalt()
     */
    public function getSalt(): ?string;

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials(): void;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): AdministratorDto;

    /**
     * @internal use EntityTools instead
     * @param null|AdministratorInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?AdministratorDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param AdministratorDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): AdministratorDto;

    public function getUsername(): string;

    public function getPass(): string;

    public function getEmail(): string;

    public function getName(): ?string;

    public function getLastname(): ?string;

    public function getActive(): int;

    public function getTimezone(): ?TimezoneInterface;
}
