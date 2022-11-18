<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\User;
use App\Form\ModuleType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('proceos/module')]
class ModuleController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'module_index', methods: ['GET'])]
    public function index(ModuleRepository $moduleRepository): Response
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $this->getUser()?->getUserIdentifier()]);
        if (in_array('ROLE_ADMIN', $user?->getRoles(), true)) {
            $modules = $moduleRepository->findAll();
        } elseif (in_array('ROLE_ORGA_ADMIN', $user?->getRoles(), true)) {
            $classes = $user?->getOrganization()?->getClasses();
            foreach ($classes as $class){
                $modulesArray = $class->getModules();
                foreach($modulesArray as $m){
                    $modules[] = $m;
                }
            }
        } elseif (in_array('ROLE_INTERVENANT', $user?->getRoles(), true)) {
            $modules = $user?->getModules();
        }
        return $this->render('module/index.html.twig', [
            'modules' => $modules,
        ]);
    }

    #[Route('/new', name: 'module_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $module = new Module();
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($module);
            $entityManager->flush();

            return $this->redirectToRoute('module_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('module/new.html.twig', [
            'module' => $module,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'module_show', methods: ['GET'])]
    public function show(Module $module): Response
    {
        return $this->render('module/show.html.twig', [
            'module' => $module,
        ]);
    }

    #[Route('/{id}/edit', name: 'module_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Module $module): Response
    {
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('module_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('module/edit.html.twig', [
            'module' => $module,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'module_delete', methods: ['POST'])]
    public function delete(Request $request, Module $module): Response
    {
        if ($this->isCsrfTokenValid('delete' . $module->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($module);
            $entityManager->flush();
        }

        return $this->redirectToRoute('module_index', [], Response::HTTP_SEE_OTHER);
    }
}
