<?php

namespace Demo\Infrastructure\Api\Jwt;

use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\PreAuthenticationJWTUserToken;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Guard\JWTTokenAuthenticator;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class AdministratorTokenAuthenticator extends JWTTokenAuthenticator
{
    public function __construct(
        private JWTTokenManagerInterface $jwtManager,
        EventDispatcherInterface $dispatcher,
        TokenExtractorInterface $tokenExtractor,
        private TokenStorageInterface $tokenStorage
    ) {
        parent::__construct($jwtManager, $dispatcher, $tokenExtractor, $tokenStorage);
    }

    public function supports(Request $request)
    {
        $canExtractToken = parent::supports($request);
        if (!$canExtractToken) {
            return false;
        }

        $payload =  $this->getCredentials($request)->getPayload();
        $roles = $payload['roles'] ?? [];

        $isUser = in_array('ROLE_ADMIN', $roles, true);

        return $isUser;
    }

    /**
     * @inheritdoc
     */
    public function getUser($preAuthToken, UserProviderInterface $userProvider)
    {
        if (!$preAuthToken instanceof PreAuthenticationJWTUserToken) {
            throw new \InvalidArgumentException(
                sprintf('The first argument of the "%s()" method must be an instance of "%s".', __METHOD__, PreAuthenticationJWTUserToken::class)
            );
        }

        $user = parent::getUser(...func_get_args());
        if ($user) {
            $this->tokenStorage->setToken($preAuthToken);
        }

        return $user;
    }
}
