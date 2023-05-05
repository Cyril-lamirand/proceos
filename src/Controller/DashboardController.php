<?php


namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[
        Route('/dashboard', name: 'dashboard', methods: ['GET']),
        IsGranted("IS_AUTHENTICATED_FULLY", message: 'No access!')
    ]
    public function index(): RedirectResponse
    {
        $user = $this->getUser();
        $roles = $user?->getRoles();

        if (in_array("ROLE_ADMIN", $roles, true) || in_array("ROLE_ORGA_ADMIN", $roles, true)) {
            return $this->redirectToRoute('admin_index');
        }

        if (in_array("ROLE_INTERVENANT", $roles, true)) {

            return $this->redirectToRoute('index_intervenant');
        }

        return $this->redirectToRoute('index_student');
    }

}