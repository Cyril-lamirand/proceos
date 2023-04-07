<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Entity\Answer;
use App\Entity\Module;
use App\Entity\Question;
use App\Entity\Quiz;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    public function __construct(private EntityManagerInterface $manager)
    {
    }

    #[Route(
        path: '/quiz/create/{id}',
        name: 'create_quiz',
        methods: ['POST', 'GET']
    )]
    public function create(Module $module): RedirectResponse|Response
    {
        if ($_POST) {
            $quiz = new Quiz();
            $quiz->setLabel($module->getLabel())
            ->setModule($module)
            ->setCreatedat(new \DateTime());
            $arrayOfQuestionsResponses = array_chunk($_POST, 2);
            foreach ($arrayOfQuestionsResponses as $questionsResponse) {
                $question = new Question();
                $question->setQuiz($quiz)
                    ->setLabel($questionsResponse[0])
                    ->setType('text');

                $answer = new Answer();
                $answer->setQuestion($question)
                    ->setCorrect(true)
                    ->setValue($questionsResponse[1]);

                $this->manager->persist($question);
                $this->manager->persist($answer);
            }

            $this->manager->persist($quiz);
            $this->manager->flush();

            $this->addFlash('success', "Quiz créé");
            return $this->redirectToRoute('index_intervenant');
        }

        return $this->render('client/teacher/create-quiz.html.twig', compact('module'));
    }

    #[Route(
        path: '/quiz/answer/{id}',
        name: 'answer_quiz',
        methods: ['POST', 'GET']
    )]
    public function answer(Quiz $quiz): Response
    {
        return $this->render('client/student/answer-quiz.html.twig', compact('quiz'));
    }
}