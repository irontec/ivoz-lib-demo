<?php

namespace Demo\Infrastructure\Service\Administrator;

use Demo\Domain\Model\Administrator\AdministratorInterface;
use Demo\Domain\Model\Administrator\AdministratorRepository;
use Demo\Domain\Service\Administrator\SendActivationEmailInterface;
use Ivoz\Core\Domain\Model\Mailer\Message;
use Ivoz\Core\Domain\Service\MailerClientInterface;
use Psr\Log\LoggerInterface;

class SendActivationEmail implements SendActivationEmailInterface
{
    public function __construct(
        private MailerClientInterface $mailer,
        private LoggerInterface $logger
    ) {
    }

    public function execute(AdministratorInterface $administrator): void
    {
        $administratorId = $administrator->getId();
        $body = 'Hello, please activate your account following this link: ' . PHP_EOL
            . 'https://10.189.4.23/demo/api/activate_admin/' . $administratorId . PHP_EOL;

        $mail = new Message();
        $mail->setBody($body, 'text/plain')
            ->setSubject('Activate your new account')
            ->setFromAddress('noreplay@irontec.com')
            ->setFromName('Irontec demo')
            ->setToAddress($administrator->getEmail());

        try {
            $this->mailer->send($mail);
        } catch (\Exception $e) {
            $errorMsg = 'Unable to send activation email';
            $this->logger->error($errorMsg . ':' . $e->getMessage());

            throw new \DomainException(
                $errorMsg,
                $e->getCode(),
                $e
            );
        }
    }
}
