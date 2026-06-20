<?php

namespace App\Mail;

use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\MessageConverter;
use Brevo\Client\Configuration;
use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Model\SendSmtpEmail;
use Brevo\Client\Model\SendSmtpEmailTo;
use Brevo\Client\Model\SendSmtpEmailSender;
use GuzzleHttp\Client;

class BrevoTransport extends AbstractTransport
{
    protected string $apiKey;

    public function __construct(string $apiKey)
    {
        parent::__construct();
        $this->apiKey = $apiKey;
    }

    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());

        $config = Configuration::getDefaultConfiguration()
            ->setApiKey('api-key', $this->apiKey);

        $apiInstance = new TransactionalEmailsApi(new Client(), $config);

        $to = [];
        foreach ($email->getTo() as $address) {
            $recipient = new SendSmtpEmailTo();
            $recipient->setEmail($address->getAddress());
            $recipient->setName($address->getName() ?? '');
            $to[] = $recipient;
        }

        $sender = new SendSmtpEmailSender();
        $fromAddresses = $email->getFrom();
        $fromAddress = reset($fromAddresses);
        $sender->setEmail($fromAddress->getAddress());
        $sender->setName($fromAddress->getName() ?? '');

        $sendEmail = new SendSmtpEmail();
        $sendEmail->setSender($sender);
        $sendEmail->setTo($to);
        $sendEmail->setSubject($email->getSubject());
        $sendEmail->setHtmlContent(
            $email->getHtmlBody() ?? nl2br($email->getTextBody() ?? '')
        );

        $apiInstance->sendTransacEmail($sendEmail);
    }

    public function __toString(): string
    {
        return 'brevo';
    }
}