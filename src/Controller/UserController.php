<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/admin/user', name: 'admin_user')]
    public function index(): Response
    {
        $users = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        return $this->render('user/index.html.twig', [
            "users" => $users,
        ]);
    }

    #[Route('/admin/update/role/{id}', name: 'admin_update_role')]
    public function updateRole(User $user,)
    {
        if ($_POST){
            $manager = $this->getDoctrine()->getManager();
            $role = $_POST['roles'];
            $user->setRoles([$role]);
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success',"User updated");
            return $this->redirectToRoute('admin_user');
        }
    }
}
