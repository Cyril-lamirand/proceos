<?php

namespace App\Controller\api;

use App\Entity\Answer;
use App\Entity\Module;
use App\Entity\Question;
use App\Entity\Quiz;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;

#[Route('/api')]
class ApiQuizController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/quiz/all/{id}', name: 'api_get_all_quiz', methods: 'get')]
    public function getAllQuiz($id): JsonResponse
    {
        $intervenant = $this->em->getRepository(User::class)->find($id);
        if ($intervenant) {
            $modules = $intervenant->getModules();
            if ($modules) {
                $returnedArray = [];
                foreach ($modules as $module) {
                    $quiz = $module->getQuiz();
                    if ($quiz) {
                        foreach ($quiz as $elm) {
                            $tempoArray = [
                                'id_module' => $module->getId(),
                                'id_label' => $module->getLabel(),
                                'id_quiz' => $elm->getId(),
                                'label_quiz' => $elm->getLabel(),
                            ];

                            $returnedArray[] = $tempoArray;
                        }
                        return new JsonResponse($returnedArray);
                    }
                    return new JsonResponse([
                        "request" => [
                            "status" => "500",
                            "message" => "Aucun quiz trouvé"
                        ]
                    ]);
                }
            }
            return new JsonResponse([
                "request" => [
                    "status" => "500",
                    "message" => "Aucun module trouvé"
                ]
            ]);
        }
        return new JsonResponse([
            "request" => [
                "status" => "500",
                "message" => "Aucune user trouvé avec cette id"
            ]
        ]);
    }

    #[Route('/quiz/{id}', name: 'api_get_quiz', methods: 'get')]
    public function getSingleQuiz($id): JsonResponse
    {

        $quiz = $this->em->getRepository(Quiz::class)->find($id);
        if ($quiz) {
            $questionArray = [];
            foreach ($quiz->getQuestions() as $question) {
                $answerArray = [];
                foreach ($question->getAnswers() as $answer) {
                    $tmpArray = [
                        'id' => $answer->getId(),
                        'value' => $answer->getValue(),
                        'correct' => $answer->getCorrect(),
                    ];

                    $answerArray[] = $tmpArray;
                }
                $tempoArray = [
                    'label' => $question->getLabel(),
                    'type' => $question->getType(),
                    'placeholder' => $question->getPlaceholder(),
                    "answer" => $answerArray
                ];
                $questionArray[] = $tempoArray;
            }
            $returnedArray = [
                'id' => $quiz->getId(),
                'label' => $quiz->getLabel(),
                'questions' => $questionArray,
            ];
            return new JsonResponse($returnedArray);
        }
        return new JsonResponse([
            "request" => [
                "status" => "500",
                "message" => "Aucun quiz trouvé"
            ]
        ]);

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