<?php

declare(strict_types=1);

namespace Demo\Domain\Model\Timezone;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;

/**
* TimezoneAbstract
* @codeCoverageIgnore
*/
abstract class TimezoneAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $tz;

    /**
     * @var string
     */
    protected $comment = '';

    /**
     * Constructor
     */
    protected function __construct(
        string $tz,
        string $comment
    ) {
        $this->setTz($tz);
        $this->setComment($comment);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Timezone",
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
    public static function createDto($id = null): TimezoneDto
    {
        return new TimezoneDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TimezoneInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TimezoneDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TimezoneInterface::class);

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
     * @param TimezoneDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TimezoneDto::class);
        $tz = $dto->getTz();
        Assertion::notNull($tz, 'getTz value is null, but non null value was expected.');
        $comment = $dto->getComment();
        Assertion::notNull($comment, 'getComment value is null, but non null value was expected.');

        $self = new static(
            $tz,
            $comment
        );

        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TimezoneDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TimezoneDto::class);

        $tz = $dto->getTz();
        Assertion::notNull($tz, 'getTz value is null, but non null value was expected.');
        $comment = $dto->getComment();
        Assertion::notNull($comment, 'getComment value is null, but non null value was expected.');

        $this
            ->setTz($tz)
            ->setComment($comment);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TimezoneDto
    {
        return self::createDto()
            ->setTz(self::getTz())
            ->setComment(self::getComment());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'tz' => self::getTz(),
            'comment' => self::getComment()
        ];
    }

    protected function setTz(string $tz): static
    {
        Assertion::maxLength($tz, 255, 'tz value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tz = $tz;

        return $this;
    }

    public function getTz(): string
    {
        return $this->tz;
    }

    protected function setComment(string $comment): static
    {
        Assertion::maxLength($comment, 150, 'comment value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->comment = $comment;

        return $this;
    }

    public function getComment(): string
    {
        return $this->comment;
    }
}
