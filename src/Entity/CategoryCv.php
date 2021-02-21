<?php

namespace App\Entity;

use App\Repository\CategoryCvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryCvRepository::class)
 */
class CategoryCv
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Cvtheque::class, mappedBy="category")
     */
    private $cvtheques;

    public function __construct()
    {
        $this->cvtheques = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Cvtheque[]
     */
    public function getCvtheques(): Collection
    {
        return $this->cvtheques;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function addCvtheque(Cvtheque $cvtheque): self
    {
        if (!$this->cvtheques->contains($cvtheque)) {
            $this->cvtheques[] = $cvtheque;
            $cvtheque->setCategory($this);
        }

        return $this;
    }

    public function removeCvtheque(Cvtheque $cvtheque): self
    {
        if ($this->cvtheques->removeElement($cvtheque)) {
            // set the owning side to null (unless already changed)
            if ($cvtheque->getCategory() === $this) {
                $cvtheque->setCategory(null);
            }
        }

        return $this;
    }

}
