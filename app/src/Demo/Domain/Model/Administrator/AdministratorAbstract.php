<?php

declare(strict_types=1);

namespace Demo\Domain\Model\Administrator;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;

/**
* AdministratorAbstract
* @codeCoverageIgnore
*/
abstract class AdministratorAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     * comment: password
     */
    protected $pass;

    /**
     * @var ?string
     */
    protected $email = null;

    /**
     * @var ?string
     */
    protected $name = null;

    /**
     * @var ?string
     */
    protected $lastname = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $username,
        string $pass
    ) {
        $this->setUsername($username);
        $this->setPass($pass);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Administrator",
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
    public static function createDto($id = null): AdministratorDto
    {
        return new AdministratorDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|AdministratorInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?AdministratorDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, AdministratorInterface::class);

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
     * @param AdministratorDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, AdministratorDto::class);
        $username = $dto->getUsername();
        Assertion::notNull($username, 'getUsername value is null, but non null value was expected.');
        $pass = $dto->getPass();
        Assertion::notNull($pass, 'getPass value is null, but non null value was expected.');

        $self = new static(
            $username,
            $pass
        );

        $self
            ->setEmail($dto->getEmail())
            ->setName($dto->getName())
            ->setLastname($dto->getLastname());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param AdministratorDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, AdministratorDto::class);

        $username = $dto->getUsername();
        Assertion::notNull($username, 'getUsername value is null, but non null value was expected.');
        $pass = $dto->getPass();
        Assertion::notNull($pass, 'getPass value is null, but non null value was expected.');

        $this
            ->setUsername($username)
            ->setPass($pass)
            ->setEmail($dto->getEmail())
            ->setName($dto->getName())
            ->setLastname($dto->getLastname());

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): AdministratorDto
    {
        return self::createDto()
            ->setUsername(self::getUsername())
            ->setPass(self::getPass())
            ->setEmail(self::getEmail())
            ->setName(self::getName())
            ->setLastname(self::getLastname());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'username' => self::getUsername(),
            'pass' => self::getPass(),
            'email' => self::getEmail(),
            'name' => self::getName(),
            'lastname' => self::getLastname()
        ];
    }

    protected function setUsername(string $username): static
    {
        Assertion::maxLength($username, 65, 'username value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->username = $username;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    protected function setPass(string $pass): static
    {
        Assertion::maxLength($pass, 80, 'pass value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->pass = $pass;

        return $this;
    }

    public function getPass(): string
    {
        return $this->pass;
    }

    protected function setEmail(?string $email = null): static
    {
        if (!is_null($email)) {
            Assertion::maxLength($email, 100, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    protected function setName(?string $name = null): static
    {
        if (!is_null($name)) {
            Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    protected function setLastname(?string $lastname = null): static
    {
        if (!is_null($lastname)) {
            Assertion::maxLength($lastname, 100, 'lastname value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->lastname = $lastname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }
}
