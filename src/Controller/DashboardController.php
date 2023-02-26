<?php


namespace App\Controller;

use App\Entity\Module;
use App\Entity\User;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends AbstractController
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    /**
     * This is the main function of this Controller
     * the objective is to return a dashboard by roles
     */
    #[Route('/dashboard',name: 'dashboard', methods: ['GET'])]
    public function index(): Response
    {
        // TODO : Check if Null / Empty
        $user = $this->getUser();
        $roles = $user->getRoles();
        if (in_array("ROLE_ADMIN", $roles)) {
            return $this->render('server/dashboard/index.html.twig');
        } elseif (in_array("ROLE_ORGA_ADMIN", $roles)) {
            return $this->render('server/dashboard/index.html.twig');
        } elseif (in_array("ROLE_INTERVENANT", $roles)) {
            $modules = $this->manager->getRepository(Module::class);
            $userModules = $modules->findBy(["user" => $this->getUser()]);
            dd($userModules);
            return $this->render('client/teacher/dashboard.html.twig',[
                "module" => $user->getModules()
            ]);
        } else {
            return $this->render('client/student/dashboard.html.twig');
        }
        return $this->render('server/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

}