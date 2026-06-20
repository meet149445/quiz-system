<?php

namespace App\Mail;

use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\MessageConverter;
use Brevo\Brevo;
use Brevo\TransactionalEmails\Requests\SendTransacEmailRequest;
use Brevo\TransactionalEmails\Types\SendTransacEmailRequestSender;
use Brevo\TransactionalEmails\Types\SendTransacEmailRequestToItem;

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

        $brevo = new Brevo($this->apiKey);

        // Build recipients
        $to = [];
        foreach ($email->getTo() as $address) {
            $to[] = new SendTransacEmailRequestToItem([
                'email' => $address->getAddress(),
                'name'  => $address->getName() ?? '',
            ]);
        }

        // Build sender
        $fromAddresses = $email->getFrom();
        $fromAddress   = reset($fromAddresses);
        $sender = new SendTransacEmailRequestSender([
            'email' => $fromAddress->getAddress(),
            'name'  => $fromAddress->getName() ?? '',
        ]);

        // Send
        // Send
try {
    $brevo->transactionalEmails->sendTransacEmail(
        new SendTransacEmailRequest([
            'subject'     => $email->getSubject(),
            'htmlContent' => $email->getHtmlBody() ?? nl2br($email->getTextBody() ?? ''),
            'sender'      => $sender,
            'to'          => $to,
        ])
    );
} catch (\Brevo\Exceptions\BrevoApiException $e) {
    $body = $e->getBody();
    $bodyStr = is_string($body) ? $body : json_encode($body);
    throw new \Exception('Brevo API Error: ' . $e->getMessage() . ' | Body: ' . $bodyStr);
}
    }

    public function __toString(): string
    {
        return 'brevo';
    }
}