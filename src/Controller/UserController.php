<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class UserController extends AbstractController
{
    #[Route('/user', name: 'admin_user')]
    public function index(): Response
    {
        $users = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        return $this->render('user/index.html.twig', [
            "users" => $users,
        ]);
    }

    #[Route('/update/role/{id}', name: 'admin_update_role')]
    public function updateRole(User $user,)
    {
        if ($_POST) {
            $manager = $this->getDoctrine()->getManager();
            $role = $_POST['roles'];
            $user->setRoles([$role]);
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', "User updated");
            return $this->redirectToRoute('admin_user');
        }
    }

    #[Route('/user/create', name: 'create_user')]
    #[Route('/user/update/{id}', name: 'update_user')]
    public function updateUser(User $user = null, Request $request)
    {
        if (!$user) {
            $user = new User();
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($_POST['courses']);
            $courses = $_POST['courses'];
            foreach ($courses as $course){
                $user->addClass($course);
            }
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('success', "User updated");
            return $this->redirectToRoute('admin_user');
        }

        return $this->render('user/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/api/classes', name: 'api_get_classes')]
    public function getClasses(): JsonResponse
    {
        $classes = $this->getDoctrine()->getManager()->getRepository(Classe::class)->findAll();
        $array = [];

        foreach ($classes as $classe) {
            $ar = [
                'label' => $classe->getLabel(),
                'id' => $classe->getId(),
            ];
            $array[] = $ar;
        }

        return $this->json($array);
    }
}
