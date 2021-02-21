<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 * @Vich\Uploadable
 */
class Formation
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
    private $lieu;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $places;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $diplomes;

    /**
     * @ORM\Column(type="text")
     */
    private $objectif;

    /**
     * @ORM\Column(type="text")
     */
    private $prerequis;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $organisme;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryFormation::class, inversedBy="formations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $eligible;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=FormationLike::class, mappedBy="formation", cascade={"remove"})
     */
    private $likes;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="formations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $auteur;

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

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPlaces(): ?int
    {
        return $this->places;
    }

    public function setPlaces(int $places): self
    {
        $this->places = $places;

        return $this;
    }

    public function getDiplomes(): ?string
    {
        return $this->diplomes;
    }

    public function setDiplomes(string $diplomes): self
    {
        $this->diplomes = $diplomes;

        return $this;
    }

    public function getObjectif(): ?string
    {
        return $this->objectif;
    }

    public function setObjectif(string $objectif): self
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getPrerequis(): ?string
    {
        return $this->prerequis;
    }

    public function setPrerequis(string $prerequis): self
    {
        $this->prerequis = $prerequis;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getOrganisme(): ?string
    {
        return $this->organisme;
    }

    public function setOrganisme(string $organisme): self
    {
        $this->organisme = $organisme;

        return $this;
    }

    public function getCategory(): ?CategoryFormation
    {
        return $this->category;
    }

    public function setCategory(?CategoryFormation $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getEligible(): ?bool
    {
        return $this->eligible;
    }

    public function setEligible(?bool $eligible): self
    {
        $this->eligible = $eligible;

        return $this;
    }

    // Upload file

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // if ($image) {
        //     $this->updatedAt = new \DateTime('now');
        // }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }


    public function setImage($image)
    {
        $this->image = $image;

    }

    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return Collection|FormationLike[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(FormationLike $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setFormation($this);
        }

        return $this;
    }

    public function removeLike(FormationLike $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getFormation() === $this) {
                $like->setFormation(null);
            }
        }

        return $this;
    }

    /**
     * Formation liké
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

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }
}
