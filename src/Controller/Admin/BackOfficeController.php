<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin')]
class BackOfficeController extends AbstractController
{

    #[Route('/', name: 'admin_index')]
    public function index(): Response
    {
        return $this->render('server/dashboard/index.html.twig');
    }
}
