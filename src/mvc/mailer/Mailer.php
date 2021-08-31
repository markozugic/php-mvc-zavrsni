<?php

namespace App\mvc\mailer;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


class Mailer
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->Host = 'mail';                
        $this->mailer->Port = 1025; 
        $this->mailer->isHTML(false);
        $this->mailer->CharSet = 'UTF-8';                               
    }

    public function send(string $name, string $from, string $message)
    {
        try { 
            $this->mailer->setFrom($from, $name);
            $this->mailer->addAddress('markozugic@gmail.com');
            $this->mailer->Subject = "Contact form message from: " . $name;
            $this->mailer->Body = $message;
        
            $this->mailer->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
        }
    }
}