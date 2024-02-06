<?php

namespace Demo\Domain\Model\Service;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;

/**
* ServiceInterface
*/
interface ServiceInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): ?int;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): ServiceDto;

    /**
     * @internal use EntityTools instead
     * @param null|ServiceInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ServiceDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ServiceDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ServiceDto;

    public function getIden(): string;
}
