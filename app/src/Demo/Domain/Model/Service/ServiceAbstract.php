<?php

declare(strict_types=1);

namespace Demo\Domain\Model\Service;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;

/**
* ServiceAbstract
* @codeCoverageIgnore
*/
abstract class ServiceAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $iden;

    /**
     * Constructor
     */
    protected function __construct(
        string $iden
    ) {
        $this->setIden($iden);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Service",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): ServiceDto
    {
        return new ServiceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ServiceInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ServiceDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ServiceInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ServiceDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ServiceDto::class);
        $iden = $dto->getIden();
        Assertion::notNull($iden, 'getIden value is null, but non null value was expected.');

        $self = new static(
            $iden
        );

        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ServiceDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ServiceDto::class);

        $iden = $dto->getIden();
        Assertion::notNull($iden, 'getIden value is null, but non null value was expected.');

        $this
            ->setIden($iden);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ServiceDto
    {
        return self::createDto()
            ->setIden(self::getIden());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'iden' => self::getIden()
        ];
    }

    protected function setIden(string $iden): static
    {
        Assertion::maxLength($iden, 50, 'iden value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->iden = $iden;

        return $this;
    }

    public function getIden(): string
    {
        return $this->iden;
    }
}
