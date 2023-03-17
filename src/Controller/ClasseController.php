<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\User;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/classe')]
class ClasseController extends AbstractController
{

    #[Route('/', name: 'classe_index', methods: ['GET'])]
    public function index(ClasseRepository $classeRepository): Response
    {
        $user = $this->getUser();
        if (in_array('ROLE_ADMIN', $user?->getRoles(), true)) {
            $classes = $classeRepository->findAll();
        } else if (in_array('ROLE_ORGA_ADMIN', $user?->getRoles(), true)) {
            $classes = $classeRepository->findByOrga($user?->getOrganization());
        } else if (in_array('ROLE_INTERVENANT', $user?->getRoles(), true)){
            $classes = $user?->getClasses();
        }

        return $this->render('server/classe/index.html.twig', [
            'classes' => $classes,
        ]);
    }

    #[Route('/new', name: 'classe_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($classe);
            $entityManager->flush();

            return $this->redirectToRoute('classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('server/classe/new.html.twig', [
            'classe' => $classe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'classe_show', methods: ['GET'])]
    public function show(Classe $classe): Response
    {
        return $this->render('server/classe/show.html.twig', [
            'classe' => $classe,
        ]);
    }

    #[Route('/{id}/edit', name: 'classe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Classe $classe): Response
    {
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('server/classe/edit.html.twig', [
            'classe' => $classe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'classe_delete', methods: ['POST'])]
    public function delete(Request $request, Classe $classe): Response
    {
        if ($this->isCsrfTokenValid('delete' . $classe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($classe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('classe_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/add/student/{id}', name: 'add_student')]
    public function addStudent(Classe $classe): RedirectResponse
    {
        if ($_POST) {
            $email = $_POST['student'];
            $student = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $email]);
            if ($student) {
                $classe->addUser($student);
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($classe);
                $manager->flush();

                return $this->redirectToRoute('classe_show', ['id' => $classe->getId()]);
            }

            throw new Exception("Any student with this email");
        }

        throw new Exception("Not method POST");
    }
}
