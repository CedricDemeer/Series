<?php
namespace App\Notification;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Sender
{
    protected $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    public function sendNewUserNotificationToAdmin(User $user)
    {
        //ecriture dna sun fichier txt
        //file_put_contents('debug.txt', $user->getEmail());
        $message = new Email();
        $message->from('acounts@series.com')
                ->to('admin@series.com')
                ->subject('new account created on serie.com')
                ->html('<h1>New Account!</h1>email: '.$user->getEmail());


        $this->mailer->send($message);
    }
}