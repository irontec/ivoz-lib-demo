<?php

namespace Demo\Domain\Model\Client;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Client
 */
class Client extends ClientAbstract implements ClientInterface
{
    use ClientTrait;

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): null|int
    {
        return $this->id;
    }
}
