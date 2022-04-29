<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/email')]
class MailerController extends AbstractController
{
    #[Route('/registration', name: 'email_registration')]
    public function registrationMail()
    {

    }
}
