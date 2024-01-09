<?php

namespace Demo\Infrastructure\Api\Jwt;

use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Symfony\Component\Security\Core\User\UserInterface;

/** @psalm-suppress InvalidExtendClass */
class AdministratorAuthenticationSuccessHandler extends AuthenticationSuccessHandler
{
    /**
     * @param UserInterface $user
     * @param string|null $jwt
     * @return \Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handleAuthenticationSuccess(UserInterface $user, $jwt = null)
    {
        $this->jwtManager->setUserIdentityField('email');

        return parent::handleAuthenticationSuccess(...func_get_args());
    }
}
