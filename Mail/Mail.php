<?php

namespace Mail;

use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    public function send(string $email, string $pseudo, string $subject, string $body): bool
    {
        $mail = new PHPMailer();
        //Set who the message is to be sent from
        $mail->setFrom('no-reply@tony.blard.13h37.io', 'DiamondDogs');
        //Set who the message is to be sent to
        $mail->addAddress($email, $pseudo);
        //Set the subject line
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        return $mail->send();
    }
}