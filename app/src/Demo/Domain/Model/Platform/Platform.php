<?php

namespace Demo\Domain\Model\Platform;

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
}
