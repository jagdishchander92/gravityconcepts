<?php

namespace App\Mail\Transport;

use SendGrid;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\Email;

class SendGridTransport extends AbstractTransport
{
    protected $client;

    public function __construct(SendGrid $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    protected function doSend(SentMessage $message): void
    {
        $email = $message->getOriginalMessage();

        if (!$email instanceof Email) {
            return;
        }

        $mail = new \SendGrid\Mail\Mail;
        $mail->setFrom($email->getFrom()[0]->getAddress(), $email->getFrom()[0]->getName());
        $mail->setSubject($email->getSubject());

        if (env('TEST_MODE', 'on') == 'off') {
            foreach ($email->getTo() as $to) {
                $mail->addTo($to->getAddress(), $to->getName());
            }
        } else {
            $mail->addTo(env('DEV_EMAIL', 'jagdish@vaticinfotech.com'), 'Developer');
        }


        $html = $email->getHtmlBody();
        $text = $email->getTextBody();

        if ($html) {
            $mail->addContent('text/html', $html);
        }

        if ($text) {
            $mail->addContent('text/plain', $text);
        }
        foreach ($email->getAttachments() as $attachment) {

            $mail->addAttachment(
                base64_encode($attachment->getBody()),
                $attachment->getMediaType() . '/' . $attachment->getMediaSubtype(),
                $attachment->getPreparedHeaders()->getHeaderParameter('Content-Disposition', 'filename'),
                'attachment'
            );
        }
        $this->client->send($mail);
    }

    public function __toString(): string
    {
        return 'sendgrid';
    }
}
