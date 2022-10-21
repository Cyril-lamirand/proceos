<?php

namespace App\Controller\api;

use App\Entity\Answer;
use App\Entity\Module;
use App\Entity\Question;
use App\Entity\Quiz;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ApiQuizController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/create/quiz', name: 'api_create_quiz', methods: 'post')]
    public function createQuiz(Request $request): JsonResponse
    {
        $form = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $module = $this->em->getRepository(Module::class)->find($form['id']);
        if ($module) {
            $quiz = new Quiz();
            $quiz->setCreatedat(new DateTimeImmutable())
                ->setLabel($form['label'])
                ->setModule($module);
            foreach ($form['questions'] as $item) {
                $question = new Question();
                $question->setQuiz($quiz)
                    ->setLabel($item['label'])
                    ->setPlaceholder($item['placeholder'])
                    ->setType($item['type']);

                foreach ($item['answer'] as $elm) {
                    $answer = new Answer();
                    $answer->setQuestion($question)
                        ->setValue($elm['value'])
                        ->setCorrect($elm['correct']);

                    $this->em->persist($answer);
                }

                $this->em->persist($question);
            }

            $this->em->persist($quiz);
            $this->em->flush();

            return new JsonResponse([
                "request" => [
                    "status" => 200,
                    "message" => "Quiz created"
                ]
            ]);
        }

        return new JsonResponse([
            "request" => [
                "status" => 500,
                "message" => "Create quiz failed",
            ]
        ]);
    }
}