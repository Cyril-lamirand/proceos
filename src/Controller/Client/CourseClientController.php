<?php

namespace App\Controller\Client;

use App\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseClientController extends AbstractController
{
    #[Route('/course/{id}', name: 'app_client_course_show')]
    public function show(Course $course): Response
    {
        return $this->render('client/course/index.html.twig', compact('course'));
    }
}
