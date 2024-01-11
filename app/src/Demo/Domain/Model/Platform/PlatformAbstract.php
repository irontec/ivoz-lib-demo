<?php

declare(strict_types=1);

namespace Demo\Domain\Model\Platform;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;

/**
* PlatformAbstract
* @codeCoverageIgnore
*/
abstract class PlatformAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var ?string
     */
    protected $apiUrl = null;

    /**
     * @var ?string
     * column: refresh_token
     */
    protected $refreshToken = null;

    /**
     * @var int
     */
    protected $tlsPort;

    /**
     * @var string
     * comment: enum:isbc|other|ivozprovider-v2|ivozprovider-v3
     */
    protected $type = 'isbc';

    /**
     * @var int
     */
    protected $tcpPort = 5060;

    /**
     * @var int
     */
    protected $udpPort = 5060;

    /**
     * @var int
     */
    protected $wssPort = 10081;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        int $tlsPort,
        string $type,
        int $tcpPort,
        int $udpPort,
        int $wssPort
    ) {
        $this->setName($name);
        $this->setTlsPort($tlsPort);
        $this->setType($type);
        $this->setTcpPort($tcpPort);
        $this->setUdpPort($udpPort);
        $this->setWssPort($wssPort);
    }

    abstract public function getId(): null|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Platform",
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
    public static function createDto($id = null): PlatformDto
    {
        return new PlatformDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|PlatformInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?PlatformDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, PlatformInterface::class);

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
     * @param PlatformDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, PlatformDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $tlsPort = $dto->getTlsPort();
        Assertion::notNull($tlsPort, 'getTlsPort value is null, but non null value was expected.');
        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $tcpPort = $dto->getTcpPort();
        Assertion::notNull($tcpPort, 'getTcpPort value is null, but non null value was expected.');
        $udpPort = $dto->getUdpPort();
        Assertion::notNull($udpPort, 'getUdpPort value is null, but non null value was expected.');
        $wssPort = $dto->getWssPort();
        Assertion::notNull($wssPort, 'getWssPort value is null, but non null value was expected.');

        $self = new static(
            $name,
            $tlsPort,
            $type,
            $tcpPort,
            $udpPort,
            $wssPort
        );

        $self
            ->setApiUrl($dto->getApiUrl())
            ->setRefreshToken($dto->getRefreshToken());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param PlatformDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, PlatformDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $tlsPort = $dto->getTlsPort();
        Assertion::notNull($tlsPort, 'getTlsPort value is null, but non null value was expected.');
        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $tcpPort = $dto->getTcpPort();
        Assertion::notNull($tcpPort, 'getTcpPort value is null, but non null value was expected.');
        $udpPort = $dto->getUdpPort();
        Assertion::notNull($udpPort, 'getUdpPort value is null, but non null value was expected.');
        $wssPort = $dto->getWssPort();
        Assertion::notNull($wssPort, 'getWssPort value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setApiUrl($dto->getApiUrl())
            ->setRefreshToken($dto->getRefreshToken())
            ->setTlsPort($tlsPort)
            ->setType($type)
            ->setTcpPort($tcpPort)
            ->setUdpPort($udpPort)
            ->setWssPort($wssPort);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): PlatformDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setApiUrl(self::getApiUrl())
            ->setRefreshToken(self::getRefreshToken())
            ->setTlsPort(self::getTlsPort())
            ->setType(self::getType())
            ->setTcpPort(self::getTcpPort())
            ->setUdpPort(self::getUdpPort())
            ->setWssPort(self::getWssPort());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'apiUrl' => self::getApiUrl(),
            'refresh_token' => self::getRefreshToken(),
            'tlsPort' => self::getTlsPort(),
            'type' => self::getType(),
            'tcpPort' => self::getTcpPort(),
            'udpPort' => self::getUdpPort(),
            'wssPort' => self::getWssPort()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 64, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setApiUrl(?string $apiUrl = null): static
    {
        if (!is_null($apiUrl)) {
            Assertion::maxLength($apiUrl, 255, 'apiUrl value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->apiUrl = $apiUrl;

        return $this;
    }

    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }

    protected function setRefreshToken(?string $refreshToken = null): static
    {
        if (!is_null($refreshToken)) {
            Assertion::maxLength($refreshToken, 255, 'refreshToken value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->refreshToken = $refreshToken;

        return $this;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    protected function setTlsPort(int $tlsPort): static
    {
        Assertion::greaterOrEqualThan($tlsPort, 0, 'tlsPort provided "%s" is not greater or equal than "%s".');

        $this->tlsPort = $tlsPort;

        return $this;
    }

    public function getTlsPort(): int
    {
        return $this->tlsPort;
    }

    protected function setType(string $type): static
    {
        Assertion::maxLength($type, 50, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $type,
            [
                PlatformInterface::TYPE_ISBC,
                PlatformInterface::TYPE_OTHER,
                PlatformInterface::TYPE_IVOZPROVIDERV2,
                PlatformInterface::TYPE_IVOZPROVIDERV3,
            ],
            'typevalue "%s" is not an element of the valid values: %s'
        );

        $this->type = $type;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    protected function setTcpPort(int $tcpPort): static
    {
        Assertion::greaterOrEqualThan($tcpPort, 0, 'tcpPort provided "%s" is not greater or equal than "%s".');

        $this->tcpPort = $tcpPort;

        return $this;
    }

    public function getTcpPort(): int
    {
        return $this->tcpPort;
    }

    protected function setUdpPort(int $udpPort): static
    {
        Assertion::greaterOrEqualThan($udpPort, 0, 'udpPort provided "%s" is not greater or equal than "%s".');

        $this->udpPort = $udpPort;

        return $this;
    }

    public function getUdpPort(): int
    {
        return $this->udpPort;
    }

    protected function setWssPort(int $wssPort): static
    {
        Assertion::greaterOrEqualThan($wssPort, 0, 'wssPort provided "%s" is not greater or equal than "%s".');

        $this->wssPort = $wssPort;

        return $this;
    }

    public function getWssPort(): int
    {
        return $this->wssPort;
    }
}
