<?php

namespace App\Entity;

use App\Repository\FiliereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FiliereRepository::class)]
class Filiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $domaine = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $condition_admission = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $debouches = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'filieres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etablissement $etablissement = null;

    /**
     * @var Collection<int, Utilisateur>
     */
    // #[ORM\ManyToMany(targetEntity: Utilisateur::class, inversedBy: 'filieresInteret')]
    private Collection $interesses;

    /**
     * @var Collection<int, Avis>
     */
    #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'filiere')]
    private Collection $avis;

    public function __construct()
    {
        $this->interesses = new ArrayCollection();
        $this->avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    public function setDomaine(string $domaine): static
    {
        $this->domaine = $domaine;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getConditionAdmission(): ?string
    {
        return $this->condition_admission;
    }

    public function setConditionAdmission(string $condition_admission): static
    {
        $this->condition_admission = $condition_admission;

        return $this;
    }

    public function getDebouches(): ?string
    {
        return $this->debouches;
    }

    public function setDebouches(?string $debouches): static
    {
        $this->debouches = $debouches;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): static
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getInteresses(): Collection
    {
        return $this->interesses;
    }

    public function addInteresse(Utilisateur $interesse): static
    {
        if (!$this->interesses->contains($interesse)) {
            $this->interesses->add($interesse);
        }

        return $this;
    }

    public function removeInteresse(Utilisateur $interesse): static
    {
        $this->interesses->removeElement($interesse);

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): static
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setFiliere($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getFiliere() === $this) {
                $avi->setFiliere(null);
            }
        }

        return $this;
    }
}
