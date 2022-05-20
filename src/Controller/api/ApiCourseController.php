<?php

namespace App\Controller\api;

use App\Entity\Course;
use App\Entity\Module;
use App\Repository\CourseRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiCourseController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager, CourseRepository $repo)
    {
        $this->manager = $manager;
        $this->repo = $repo;
    }

    /**
     * @throws \JsonException
     */
    #[Route('/add/course', name: 'api_course', methods: 'post')]
    public function addNewCourse(Request $request): JsonResponse
    {
        $form = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        if ($form) {
            $module = $this->manager->getRepository(Module::class)->find($form['module_id']);
            if ($module) {
                $course = new Course();
                $course->setCreatedat(new DateTime('NOW'))
                    ->setModule($module)
                    ->setTitle($form['title'])
                    ->setContent($form['content']);

                $this->manager->persist($course);
                $this->manager->flush();

                return new JsonResponse([
                    "status" => "200",
                    "message" => "Course created"
                ]);
            }
            return new JsonResponse([
                "status" => "500",
                "message" => "Module introuvable"
            ]);

        }
        return new JsonResponse([
            "status" => "500",
            "error" => "Problème lors de la création du cours"
        ]);
    }
}