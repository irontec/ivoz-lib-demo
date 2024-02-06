<?php

namespace App\Controller\Administrator;

use Demo\Domain\Model\Administrator\AdministratorRepository;
use Demo\Domain\Service\Administrator\SendActivationEmailInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SendActivationEmail
{
    public function __construct(
        private SendActivationEmailInterface $sendActivationEmail,
        private AdministratorRepository $administratorRepository
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $response = new Response();

        $administratorId = (int) $request->attributes->get('id');

        $administrator = $this->administratorRepository->find($administratorId);
        if ($administrator === null) {
            throw new \DomainException("Resource not found", 404);
        }

        $this->sendActivationEmail->execute($administrator);
        $response->setStatusCode(200);

        return $response;
    }
}
