<?php

namespace Demo\Domain\Model\Platform;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* PlatformInterface
*/
interface PlatformInterface extends EntityInterface, LoggableEntityInterface
{
    public const TYPE_ISBC = 'isbc';

    public const TYPE_OTHER = 'other';

    public const TYPE_IVOZPROVIDERV2 = 'ivozprovider-v2';

    public const TYPE_IVOZPROVIDERV3 = 'ivozprovider-v3';

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): string|int;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): PlatformDto;

    /**
     * @internal use EntityTools instead
     * @param null|PlatformInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?PlatformDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param PlatformDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): PlatformDto;

    public function getName(): string;

    public function getApiUrl(): ?string;

    public function getRefreshToken(): ?string;

    public function getTlsPort(): int;

    public function getType(): string;

    public function getTcpPort(): int;

    public function getUdpPort(): int;

    public function getWssPort(): int;
}
