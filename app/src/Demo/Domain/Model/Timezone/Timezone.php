<?php

namespace Demo\Domain\Model\Timezone;

/**
 * Timezone
 */
class Timezone extends TimezoneAbstract implements TimezoneInterface
{
    use TimezoneTrait;

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
