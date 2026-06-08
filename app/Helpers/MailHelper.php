<?php

use Illuminate\Support\Facades\Log;

function send_email($to, string $subject, $body, string $cc = '', string $bcc = '', array $attachments = [])
{
    $email = new \SendGrid\Mail\Mail;
    $email->setFrom(env('MAIL_FROM_ADDRESS'), '-');
    $email->setSubject($subject);
    if (env('TEST_MODE', 'on') == 'off') {
        //for production env

        //to
        if (!empty($to)) {
            if (is_array($to)) {
                foreach ($to as $recipientEmail) {
                    $email->addTo(trim($recipientEmail));
                }
            } else {
                $email->addTo(trim($to));
            }
        }
        // CC
        if (!empty($cc)) {
            foreach (explode(',', $cc) as $cc_email) {
                $email->addCC(trim($cc_email));
            }
        }
        // BCC
        if (!empty($bcc)) {
            foreach (explode(',', $bcc) as $bcc_email) {
                $email->addBcc(trim($bcc_email));
            }
        }
    } else {
        //for local env

        $email->addTo(trim(env('DEV_EMAIL', 'jagdish@vaticinfotech.com')), 'Developer');
    }
    $email->addContent('text/html', $body);

    // Attachments
    if (!empty($attachments)) {
        foreach ($attachments as $attachment) {
            if (file_exists($attachment)) {
                $email->addAttachment(
                    base64_encode(file_get_contents($attachment)),
                    mime_content_type($attachment),
                    basename($attachment),
                    'attachment'
                );
            } else {
                throw new Exception("Attachment not found: $attachment");
            }
        }
    }

    $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
    try {
        if (!empty($to)) {
            $response = $sendgrid->send($email);
            if ($response->statusCode() >= 200 && $response->statusCode() < 300) {
                return true;
            } else {
                Log::error('SendGrid Error: ' . $response->body());
                return false;
            }
        } else {
            return false;
        }
    } catch (Exception $e) {
        Log::error('SendGrid Exception: ' . $e->getMessage());
        return false;
    }
}
