<?php

namespace App\Controller\Client;

use App\Entity\Module;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModuleClientController extends AbstractController
{
    #[Route('/module/{id}', name: 'app_client_module_show', methods: ['GET'])]
    public function show(Module $module): Response|RedirectResponse
    {
        foreach ($module->getStudentLevels() as $level){
            if ($level->getUser()->getId() == $this->getUser()->getId()){
                return $this->render('client/module/index.html.twig', compact('module', 'level'));

            }
        }

        return $this->redirectToRoute('dashboard');
    }

    #[Route(
        path: "/teacher/module/{id}",
        name: 'app_client_teacher_module_show',
        methods: ['GET']
    )]
    public function teacherShow(Module $module): Response
    {
        return $this->render('client/module/teacher_show.html.twig', compact('module'));
    }
}
