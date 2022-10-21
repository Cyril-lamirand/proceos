<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\User;
use App\Form\UserType;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('proceos/admin')]
class UserController extends AbstractController
{
    #[Route('/user', name: 'admin_user')]
    public function index(): Response
    {
        $role = $this->getUser()?->getRoles();

        if (in_array('ROLE_ORGA_ADMIN', $role, true)) {
            $users = $this->getDoctrine()->getManager()->getRepository(User::class)->findByOrga($this->getUser()?->getOrganization());
        } else {
            $users
                = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        }
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
    public function updateUser(User $user = null, Request $request, UserPasswordHasherInterface $passwordHasher, SluggerInterface $slugger): RedirectResponse|Response
    {
        if (!$user) {
            $user = new User();
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $manager = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $courses = explode(',', $_POST['courses']);
            foreach ($courses as $id) {
                $course = $manager->getRepository(Classe::class)->find($id);
                if ($courses) {
                    $user->addClass($course);
                }
            }
            $user->setPassword($passwordHasher->hashPassword(
                $user,
                'motdepasse'
            ));
            $profilePicture = $form->get('profilepicture')->getData();
            if ($profilePicture) {
                $fileUploader = new FileUploader($this->getParameter('users'), $slugger);
                $ppName = $fileUploader->upload($profilePicture);
                $user->setProfilepicture($ppName);
            }
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('success', "User updated");
            return $this->redirectToRoute('admin_user');
        }

        return $this->render('user/form.html.twig', [
            'form' => $form->createView(),
            "user" => $user
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
