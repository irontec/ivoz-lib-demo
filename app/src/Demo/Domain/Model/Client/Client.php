<?php

namespace Demo\Domain\Model\Client;

/**
 * Client
 */
class Client extends ClientAbstract implements ClientInterface
{
    use ClientTrait;

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
    public function getId(): int|string
    {
        return $this->id;
    }
}
