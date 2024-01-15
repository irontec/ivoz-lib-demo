<?php

namespace Demo\Domain\Model\Client;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Client
 */
class Client extends ClientAbstract implements ClientInterface
{
    use ClientTrait;

    public const DEFAULT_PLATFORM_CLIENT_PREFIX = 'platformUser';

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): null|int
    {
        return $this->id;
    }
}
