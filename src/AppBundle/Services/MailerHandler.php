<?php
namespace AppBundle\Services;

class MailerHandler
{
    protected $mailer;

    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    public function send($subj, $from, $to, $letter)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subj)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($letter);

        $this->$mailer->send($message);

        return $this->render('default/index.html.twig');
    }
}
