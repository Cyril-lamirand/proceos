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
        // TODO : Check if Null / Empty
        $user = $this->getUser();
        $roles = $user->getRoles();
        if (in_array("ROLE_ADMIN", $roles)) {
            return $this->render('server/dashboard/index.html.twig');
        } elseif (in_array("ROLE_ORGA_ADMIN", $roles)) {
            return $this->render('server/dashboard/index.html.twig');
        } elseif (in_array("ROLE_INTERVENANT", $roles)) {
            return $this->render('client/teacher/dashboard.html.twig');
        } else {
            return $this->render('client/student/dashboard.html.twig');
        }
        return $this->render('server/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}