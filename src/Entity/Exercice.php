<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExerciceRepository::class)
 */
class Exercice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Module::class, inversedBy="exercices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $module;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdat;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datelimit;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contentbeginner;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contentintermediate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contentexpert;

    /**
     * @ORM\OneToMany(targetEntity=ExerciceWork::class, mappedBy="exercice")
     */
    private $exerciceWorks;

    public function __construct()
    {
        $this->exerciceWorks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): self
    {
        $this->module = $module;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getDatelimit(): ?\DateTimeInterface
    {
        return $this->datelimit;
    }

    public function setDatelimit(?\DateTimeInterface $datelimit): self
    {
        $this->datelimit = $datelimit;

        return $this;
    }

    public function getContentbeginner(): ?string
    {
        return $this->contentbeginner;
    }

    public function setContentbeginner(string $contentbeginner): self
    {
        $this->contentbeginner = $contentbeginner;

        return $this;
    }

    public function getContentintermediate(): ?string
    {
        return $this->contentintermediate;
    }

    public function setContentintermediate(?string $contentintermediate): self
    {
        $this->contentintermediate = $contentintermediate;

        return $this;
    }

    public function getContentexpert(): ?string
    {
        return $this->contentexpert;
    }

    public function setContentexpert(?string $contentexpert): self
    {
        $this->contentexpert = $contentexpert;

        return $this;
    }

    /**
     * @return Collection|ExerciceWork[]
     */
    public function getExerciceWorks(): Collection
    {
        return $this->exerciceWorks;
    }

    public function addExerciceWork(ExerciceWork $exerciceWork): self
    {
        if (!$this->exerciceWorks->contains($exerciceWork)) {
            $this->exerciceWorks[] = $exerciceWork;
            $exerciceWork->setExercice($this);
        }

        return $this;
    }

    public function removeExerciceWork(ExerciceWork $exerciceWork): self
    {
        if ($this->exerciceWorks->removeElement($exerciceWork)) {
            // set the owning side to null (unless already changed)
            if ($exerciceWork->getExercice() === $this) {
                $exerciceWork->setExercice(null);
            }
        }

        return $this;
    }
}
