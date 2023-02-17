<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends AbstractController
{
    #[Route('/',name: 'dashboard', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('server/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}