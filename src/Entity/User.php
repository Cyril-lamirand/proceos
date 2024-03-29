<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\ManyToMany(targetEntity=Classe::class, mappedBy="users")
     */
    private $classes;

    /**
     * @ORM\OneToMany(targetEntity=Module::class, mappedBy="user")
     */
    private $modules;

    /**
     * @ORM\OneToMany(targetEntity=QuizWork::class, mappedBy="user")
     */
    private $quizWorks;

    /**
     * @ORM\OneToMany(targetEntity=ExerciceWork::class, mappedBy="user")
     */
    private $exerciceWorks;

    /**
     * @ORM\OneToMany(targetEntity=Topic::class, mappedBy="user")
     */
    private $topics;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="user")
     */
    private $messages;

    /**
     * @ORM\ManyToOne(targetEntity=Organization::class, inversedBy="users")
     */
    private $organization;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $profilepicture;

    /**
     * @ORM\OneToOne(targetEntity=UserAvatar::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $userAvatar;

    /**
     * @ORM\OneToMany(targetEntity=StudentLevel::class, mappedBy="user", orphanRemoval=true)
     */
    private $studentLevels;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
        $this->modules = new ArrayCollection();
        $this->quizWorks = new ArrayCollection();
        $this->exerciceWorks = new ArrayCollection();
        $this->topics = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->studentLevels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getClasses(): Collection
    {
        if ($this->classes != null) {
            $mainArray = array();
            foreach ($this->classes as $userClass) {
                $mainArray[] = [
                    "id" => $userClass->getId(),
                    "label" => $userClass->getLabel()
                ];
            }

        } else {
            $arrayCollection = [
                "class" => [
                    "message" => "No classroom yet.",
                ]
            ];
            return new ArrayCollection($arrayCollection);
        }

        return new ArrayCollection($mainArray);
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
            $class->addUser($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            $class->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Module[]
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
            $module->setUser($this);
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        if ($this->modules->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getUser() === $this) {
                $module->setUser(null);
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
            $quizWork->setUser($this);
        }

        return $this;
    }

    public function removeQuizWork(QuizWork $quizWork): self
    {
        if ($this->quizWorks->removeElement($quizWork)) {
            // set the owning side to null (unless already changed)
            if ($quizWork->getUser() === $this) {
                $quizWork->setUser(null);
            }
        }

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
            $exerciceWork->setUser($this);
        }

        return $this;
    }

    public function removeExerciceWork(ExerciceWork $exerciceWork): self
    {
        if ($this->exerciceWorks->removeElement($exerciceWork)) {
            // set the owning side to null (unless already changed)
            if ($exerciceWork->getUser() === $this) {
                $exerciceWork->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Topic[]
     */
    public function getTopics(): Collection
    {
        return $this->topics;
    }

    public function addTopic(Topic $topic): self
    {
        if (!$this->topics->contains($topic)) {
            $this->topics[] = $topic;
            $topic->setUser($this);
        }

        return $this;
    }

    public function removeTopic(Topic $topic): self
    {
        if ($this->topics->removeElement($topic)) {
            // set the owning side to null (unless already changed)
            if ($topic->getUser() === $this) {
                $topic->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setUser($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getUser() === $this) {
                $message->setUser(null);
            }
        }

        return $this;
    }

    public function getOrganization(): ?Organization
    {
        return $this->organization;
    }

    public function setOrganization(?Organization $organization): self
    {
        $this->organization = $organization;

        return $this;
    }

    public function getProfilepicture(): ?string
    {
        return $this->profilepicture;
    }

    public function setProfilepicture(string $profilepicture): self
    {
        $this->profilepicture = $profilepicture;

        return $this;
    }

    public function getUserAvatar(): ?UserAvatar
    {
        return $this->userAvatar;
    }

    public function setUserAvatar(UserAvatar $userAvatar): self
    {
        // set the owning side of the relation if necessary
        if ($userAvatar->getUser() !== $this) {
            $userAvatar->setUser($this);
        }

        $this->userAvatar = $userAvatar;

        return $this;
    }

    /**
     * @return Collection<int, StudentLevel>
     */
    public function getStudentLevels(): Collection
    {
        return $this->studentLevels;
    }

    public function addStudentLevel(StudentLevel $studentLevel): self
    {
        if (!$this->studentLevels->contains($studentLevel)) {
            $this->studentLevels[] = $studentLevel;
            $studentLevel->setUser($this);
        }

        return $this;
    }

    public function removeStudentLevel(StudentLevel $studentLevel): self
    {
        if ($this->studentLevels->removeElement($studentLevel)) {
            // set the owning side to null (unless already changed)
            if ($studentLevel->getUser() === $this) {
                $studentLevel->setUser(null);
            }
        }

        return $this;
    }
}
