<?php

namespace App\Controller\Admin;

use App\Entity\Course;
use App\Form\CourseType;
use App\Repository\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/course')]
class CourseController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    #[Route('/', name: 'course_index', methods: ['GET'])]
    public function index(CourseRepository $courseRepository): Response
    {
        $user = $this->getUser();
        if (in_array('ROLE_ADMIN', $user?->getRoles(), true)) {
            $courses = $courseRepository->findAll();
        } else {
            $orga = $user?->getOrganization();
            if ($orga) {
                $users = $orga->getUsers();
                $courses = [];
                foreach ($users as $usr){
                    $modules = $usr->getModules();
                    foreach ($modules as $module) {
                        $c = $module->getCourses();
                        foreach ($c as $element) {
                            $courses[] = $element;
                        }
                    }
                }
            }
        }
        return $this->render('server/course/index.html.twig', compact('courses'));
    }

    #[Route('/new', name: 'course_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $course = new Course();
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($course);
            $this->em->flush();

            return $this->redirectToRoute('course_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/course/new.html.twig', [
            'course' => $course,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'course_show', methods: ['GET'])]
    public function show(Course $course): Response
    {
        return $this->render('server/course/show.html.twig', compact('course'));
    }

    #[Route('/{id}/edit', name: 'course_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Course $course): Response
    {
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('course_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/course/edit.html.twig', [
            'course' => $course,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'course_delete', methods: ['POST'])]
    public function delete(Request $request, Course $course): Response
    {
        if ($this->isCsrfTokenValid('delete' . $course->getId(), $request->request->get('_token'))) {
            $this->em->remove($course);
            $this->em->flush();
        }

        return $this->redirectToRoute('course_index', [], Response::HTTP_SEE_OTHER);
    }
}
