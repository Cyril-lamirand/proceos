<?php

namespace App\Controller;


use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/email')]
class MailerController extends AbstractController
{
    #[Route('/registration', name: 'email_registration')]
    public function registrationMail(MailerInterface $mailer)
    {
        $email = (new TemplatedEmail())
            ->from(new Address('proceos@gmail.com'))
            ->to(new Address('mathiasgilles136@gmail.com'))
            ->subject('Registration to proceos')
            ->htmlTemplate('email/registration_email.html.twig')
            ->context([
                'username' => 'foo',
            ]);

        try {
            $mailer->send($email);
            return $this->redirectToRoute('home');
        }catch (TransportExceptionInterface $e){
            dd($e);
        }

    }
}
