<?php

namespace App\Controller\Administrator;

use Demo\Application\Service\Administrator\ActivateAdministrator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Activate
{
    public function __construct(
        private ActivateAdministrator $activateAdministrator
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $administratorId = (int) $request->get('id');

        $this->activateAdministrator->execute($administratorId);

        return new Response('Administrator activated', 200);
    }
}
