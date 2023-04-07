<?php

namespace App\Controller\Client;

use App\Entity\Module;
use App\Entity\Classe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    public function __construct(private EntityManagerInterface $manager)
    {
    }

    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('client/homepage/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route("/dashboard/teacher", name: 'index_intervenant', methods: ['GET'])]
    public function intervenantDashboard(): Response
    {

        $modules = $this->manager->getRepository(Module::class);
        $userModules = $modules->findBy(["user" => $this->getUser()]);

        return $this->render('client/teacher/dashboard.html.twig',[
            "modules" => $userModules
        ]);
    }

    #[Route('/dashboard', name: 'index_student', methods: ['GET'])]
    public function studentDashboard(): Response
    {
        foreach ($this->getUser()->getClasses() as $class) {
            $classFound = $this->manager->getRepository(Classe::class)->find($class['id']);
            if ($classFound) {
                $modules = $classFound->getModules();
            }
        }
        return $this->render('client/student/dashboard.html.twig', compact('modules'));
    }
}
