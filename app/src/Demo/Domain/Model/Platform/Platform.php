<?php

namespace Demo\Domain\Model\Platform;

use Assert\Assertion;

/**
 * Platform
 */
class Platform extends PlatformAbstract implements PlatformInterface
{
    use PlatformTrait;

    /**
     * @codeCoverageIgnore
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

    public function setApiUrl(?string $apiUrl = null): static
    {
        if (!is_null($apiUrl)) {
            Assertion::url($apiUrl, "apiRUL must be a valid URL");
        }

        return parent::setApiUrl($apiUrl);
    }

    protected function sanitizeValues(): void
    {
        if ($this->type == Platform::TYPE_ISBC) {
            // Launches a InvalidArgumentExceptionClass
            Assertion::eq($this->tcpPort, 5050);
        }

        // Method for login an error without telling users about it.
        //throw new \DomainException("This is not for final users", 401);
    }
}
