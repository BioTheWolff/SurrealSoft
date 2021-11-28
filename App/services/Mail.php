<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

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

    public static function sendMail(string $client_email, string $nonce): string
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
            $mail->Subject = "[SurrealSoft] Inscription au service";
            $mail->Body = self::getHTMLBody($nonce);
            $mail->AltBody = self::getNoHTMLBody($nonce);

            return ! $mail->send() ? $mail->ErrorInfo : "OK";
        }
        catch (Exception $e)
        {
            return "problem: $e";
        }
    }

    private static function getHTMLBody(string $nonce): string
    {
        return "<html lang='fr'>
                    <head>
                        <meta charset='utf-8'>
                        <title>SurrealSoft | Confirmation d'inscription</title>
                    </head>
                    <body>
                        <h2>SurrealSoft</h2>
                        <h4>Confirmation d'inscription</h4>
                        <p>Afin de confirmer votre inscription, veuillez vous connecter en cliquant ici :</p>
                        <a href='https://webinfo.iutmontp.univ-montp2.fr/~zoccolaf/surrealsoft/?action=connect&nonce=$nonce'>Confirmer mon adresse e-mail</a>
                    </body>
                </html>";
    }

    private static function getNoHTMLBody(string $nonce): string
    {
        return "Pour valider votre inscription, veuillez suivre ce lien : https://webinfo.iutmontp.univ-montp2.fr/~zoccolaf/surrealsoft/?action=connect&nonce=$nonce";
    }

}