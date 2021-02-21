<?php

namespace App\Entity;

use App\Repository\EmploiLikeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmploiLikeRepository::class)
 */
class EmploiLike
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Emploi::class, inversedBy="likes")
     */
    private $emploi;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="emploiLikes")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmploi(): ?Emploi
    {
        return $this->emploi;
    }

    public function setEmploi(?Emploi $emploi): self
    {
        $this->emploi = $emploi;

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
