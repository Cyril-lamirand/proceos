<?php

namespace App\Controller\Client;

use App\Entity\Module;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModuleClientController extends AbstractController
{
    #[Route(path: '/module/{id}', name: 'app_client_module_show', methods: ['GET'])]
    public function show(Module $module, CourseRepository $courseRepository): Response
    {
        $courses = $courseRepository->findBy(["module" => $module]);
        return $this->render('client/module/index.html.twig', compact('module', 'courses'));
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
