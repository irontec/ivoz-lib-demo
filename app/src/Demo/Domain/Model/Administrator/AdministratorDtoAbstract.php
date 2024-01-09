<?php

namespace Demo\Domain\Model\Administrator;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;

/**
* AdministratorDtoAbstract
* @codeCoverageIgnore
*/
abstract class AdministratorDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $username = null;

    /**
     * @var string|null
     */
    private $pass = null;

    /**
     * @var string|null
     */
    private $email = null;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $lastname = null;

    /**
     * @var int|null
     */
    private $id = null;

    public function __construct(?int $id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'username' => 'username',
            'pass' => 'pass',
            'email' => 'email',
            'name' => 'name',
            'lastname' => 'lastname',
            'id' => 'id'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'username' => $this->getUsername(),
            'pass' => $this->getPass(),
            'email' => $this->getEmail(),
            'name' => $this->getName(),
            'lastname' => $this->getLastname(),
            'id' => $this->getId()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setPass(string $pass): static
    {
        $this->pass = $pass;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param int|null $id
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
