<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once Path::getapp(['services', 'PHPMailer', 'PHPMailer']);
require_once Path::getapp(['services', 'PHPMailer', 'Exception']);
require_once Path::getapp(['services', 'PHPMailer', 'SMTP']);


class Mail
{
    public static function generateNonce(): string
    {
        $numbytes = 16;
        $bytes = openssl_random_pseudo_bytes($numbytes);
        return bin2hex($bytes);
    }

    public static function sendMail(string $client_email, string $nonce): bool
    {
        $mail = new PHPMailer();

        try
        {
            // Server settings
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->Host = Config::get("mail.host");
            $mail->Username = Config::get("mail.user");
            $mail->Password = Config::get("mail.pass");
            $mail->Port = Config::get("mail.port");

            // Mail recipients
            $mail->setFrom(Config::get("mail.user"), "SurrealSoft");
            $mail->addAddress($client_email);
            $mail->addReplyTo(Config::get("mail.user"), "SurrealSoft");

            // Content
            $mail->isHTML(true);
            $mail->Subject = "[SurrealSoft] Vérification d'inscription";
            $mail->Body = "$nonce";
            $mail->AltBody = "$nonce";

            if (!$mail->send())
            {
                return $mail->ErrorInfo;
            }
            else return true;
        }
        catch (Exception $e)
        {
            return false;
        }
    }

}