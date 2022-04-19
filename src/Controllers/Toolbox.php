<?php

namespace App\Controllers;

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class Toolbox
{
    /**
     * Création de la session d'un utilisateur connecté
     * @param mixed $user
     * @return void
     */
    public static function createSession($user)
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
        }
        $_SESSION["user"] = [
            "id" => $user->id,
            "firstname" => $user->firstname,
            "lastname" => $user->lastname,
            "email" => $user->email,
            "description" => $user->description,
            "image" => $user->image,
            "date" => $user->date,
            "role" => [$user->role, "ROLE_USER"]
        ];
    }

    /**
     * Méthode pour créer un message flash
     * @param string $type
     * @param string $message
     * @return void
     */
    public static function flashMessage(string $type, string $message)
    {
        $_SESSION["FLASH_MESSAGE"][] = [
            "type" => $type,
            "message" => $message
        ];
    }

    /**
     * Méthode pour envoyer un email
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $html
     * @return void
     */
    public static function sendEmail(string $to, string $subject, string $html, string $from = ADMIN_EMAIL): void
    {
        $transport = Transport::fromDsn(MAILER_DSN);
        $mailer = new Mailer($transport);

        $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->text('Ceci est du text')
            ->html($html);

        $mailer->send($email);
    }
}