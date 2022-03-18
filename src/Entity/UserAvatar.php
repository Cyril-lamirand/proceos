<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserAvatarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserAvatarRepository::class)
 */
#[ApiResource]
class UserAvatar
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
    private $topType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $accessoriesType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hairColor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $facialHairType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $clotheType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eyeType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eyebrowType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mouthType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $skinColor;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="userAvatar", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTopType(): ?string
    {
        return $this->topType;
    }

    public function setTopType(string $topType): self
    {
        $this->topType = $topType;

        return $this;
    }

    public function getAccessoriesType(): ?string
    {
        return $this->accessoriesType;
    }

    public function setAccessoriesType(string $accessoriesType): self
    {
        $this->accessoriesType = $accessoriesType;

        return $this;
    }

    public function getHairColor(): ?string
    {
        return $this->hairColor;
    }

    public function setHairColor(string $hairColor): self
    {
        $this->hairColor = $hairColor;

        return $this;
    }

    public function getFacialHairType(): ?string
    {
        return $this->facialHairType;
    }

    public function setFacialHairType(string $facialHairType): self
    {
        $this->facialHairType = $facialHairType;

        return $this;
    }

    public function getClotheType(): ?string
    {
        return $this->clotheType;
    }

    public function setClotheType(string $clotheType): self
    {
        $this->clotheType = $clotheType;

        return $this;
    }

    public function getEyeType(): ?string
    {
        return $this->eyeType;
    }

    public function setEyeType(string $eyeType): self
    {
        $this->eyeType = $eyeType;

        return $this;
    }

    public function getEyebrowType(): ?string
    {
        return $this->eyebrowType;
    }

    public function setEyebrowType(string $eyebrowType): self
    {
        $this->eyebrowType = $eyebrowType;

        return $this;
    }

    public function getMouthType(): ?string
    {
        return $this->mouthType;
    }

    public function setMouthType(string $mouthType): self
    {
        $this->mouthType = $mouthType;

        return $this;
    }

    public function getSkinColor(): ?string
    {
        return $this->skinColor;
    }

    public function setSkinColor(string $skinColor): self
    {
        $this->skinColor = $skinColor;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
