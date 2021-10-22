<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuizRepository::class)
 */
class Quiz
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\OneToOne(targetEntity=Module::class, inversedBy="quiz", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $module;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdat;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="quiz")
     */
    private $questions;

    /**
     * @ORM\OneToMany(targetEntity=QuizWork::class, mappedBy="quiz")
     */
    private $quizWorks;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->quizWorks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(Module $module): self
    {
        $this->module = $module;

        return $this;
    }

    public function getCreatedat(): ?\DateTimeInterface
    {
        return $this->createdat;
    }

    public function setCreatedat(\DateTimeInterface $createdat): self
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setQuiz($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuiz() === $this) {
                $question->setQuiz(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|QuizWork[]
     */
    public function getQuizWorks(): Collection
    {
        return $this->quizWorks;
    }

    public function addQuizWork(QuizWork $quizWork): self
    {
        if (!$this->quizWorks->contains($quizWork)) {
            $this->quizWorks[] = $quizWork;
            $quizWork->setQuiz($this);
        }

        return $this;
    }

    public function removeQuizWork(QuizWork $quizWork): self
    {
        if ($this->quizWorks->removeElement($quizWork)) {
            // set the owning side to null (unless already changed)
            if ($quizWork->getQuiz() === $this) {
                $quizWork->setQuiz(null);
            }
        }

        return $this;
    }
}
