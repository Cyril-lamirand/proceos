<?php

namespace App\Controller\Admin;

use App\Entity\Classe;
use App\Entity\Organization;
use App\Entity\User;
use App\Form\UserType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('admin/admin')]
class UserController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    #[Route('/user', name: 'admin_user')]
    public function index(): Response
    {
        $role = $this->getUser()?->getRoles();

        if (in_array('ROLE_ORGA_ADMIN', $role, true)) {
            $users = $this->em->getRepository(User::class)->findByOrga($this->getUser()?->getOrganization());
        } else {
            $users = $this->em->getRepository(User::class)->findAll();
        }
        return $this->render('server/user/index.html.twig', compact('users'));
    }

    #[Route('/update/role/{id}', name: 'admin_update_role')]
    public function updateRole(User $user,)
    {
        if ($_POST) {
            $role = $_POST['roles'];
            $user->setRoles([$role]);
            $this->em->persist($user);
            $this->em->flush();

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
        if ($form->isSubmitted() && $form->isValid()) {
            $courses = explode(',', $_POST['courses']);
            foreach ($courses as $id) {
                $course = $this->em->getRepository(Classe::class)->find($id);
                if ($course) {
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
            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', "User updated");
            return $this->redirectToRoute('admin_user');
        }

        return $this->render('server/user/form.html.twig', [
            'form' => $form->createView(),
            "user" => $user
        ]);
    }

    #[Route('/api/classes/{id}', name: 'api_get_classes')]
    public function getClasses($id): JsonResponse
    {
        $orga = $this->em->getRepository(Organization::class)->find($id);
        if ($orga) {
            $array = [];
            foreach ($orga->getClasses() as $classe) {
                $ar = [
                    'label' => $classe->getLabel(),
                    'id' => $classe->getId(),
                ];
                $array[] = $ar;
            }
            return $this->json($array);
        }
        return new JsonResponse([
            "status" => 500,
            "message" => "Any organization with this id"
        ]);
    }
}
