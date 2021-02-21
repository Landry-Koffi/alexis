<?php

namespace App\Entity;

use App\Repository\CvLikeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CvLikeRepository::class)
 */
class CvLike
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Cvtheque::class, inversedBy="likes")
     */
    private $cv;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="cvLikes")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCv(): ?Cvtheque
    {
        return $this->cv;
    }

    public function setCv(?Cvtheque $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
