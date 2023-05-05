<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Entity\Module;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClasseController extends AbstractController
{
    #[Route(
        path: "/student/level/{id}/{label}",
        name: "app_client_show_student_level",
        methods: ['GET']
    )]
    public function index(User $user, Module $module): Response
    {
        return $this->render('client/classe/index.html.twig', compact('user', 'module'));
    }
}