<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CvthequeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CvthequeRepository::class)
 */
class Cvtheque
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryCv::class, inversedBy="cvtheques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disponible;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="cvtheque")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reference;

    /**
     * @ORM\OneToMany(targetEntity=CvLike::class, mappedBy="cv", cascade={"remove"})
     */
    private $likes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cv;

    /**
     * @ORM\Column(type="integer")
     */
    private $experience;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contrat;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?CategoryCv
    {
        return $this->category;
    }

    public function setCategory(?CategoryCv $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function getReference(): ?User
    {
        return $this->reference;
    }

    public function setReference(User $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return Collection|CvLike[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(CvLike $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setCv($this);
        }

        return $this;
    }

    public function removeLike(CvLike $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getCv() === $this) {
                $like->setCv(null);
            }
        }

        return $this;
    }


    /**
     * Cv liké
     *
     * @param User $user
     * @return boolean
     */
    public function isLikeByUser(User $user) : bool {
        foreach($this->likes as $like) {
            if ($like->getUser() === $user) return true;
        }
        return false;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getContrat(): ?string
    {
        return $this->contrat;
    }

    public function setContrat(string $contrat): self
    {
        $this->contrat = $contrat;

        return $this;
    }
    

}
