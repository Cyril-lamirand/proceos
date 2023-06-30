<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Entity\Course;
use App\Form\TeacherCourseType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CourseClientController extends AbstractController
{
    #[Route('/course/{id}', name: 'app_client_course_show')]
    public function show(Course $course): Response
    {
        return $this->render('client/course/index.html.twig', compact('course'));
    }

    #[Route('/teacher/course-edit/{id}', name: 'app_client_course_edit')]
    public function edit(Course $course, Request $request, EntityManagerInterface $emi): Response
    {
        $form = $this->createForm(TeacherCourseType::class, $course);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $emi->persist($course);
            $emi->flush();
            return $this->redirectToRoute("index_intervenant");
        }

        return $this->render('client/course/edit.html.twig', [
            'course' => $course,
            'form' => $form->createView()
        ]);
    }
}
