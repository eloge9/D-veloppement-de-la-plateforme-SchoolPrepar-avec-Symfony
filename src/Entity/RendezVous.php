<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendezVousRepository::class)]
class RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    #[ORM\Column(length: 100)]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVouses')]
    private ?Utilisateur $eleve = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVouses')]
    private ?Utilisateur $conseiller = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getEleve(): ?Utilisateur
    {
        return $this->eleve;
    }

    public function setEleve(?Utilisateur $eleve): static
    {
        $this->eleve = $eleve;

        return $this;
    }

    public function getConseiller(): ?Utilisateur
    {
        return $this->conseiller;
    }

    public function setConseiller(?Utilisateur $conseiller): static
    {
        $this->conseiller = $conseiller;

        return $this;
    }
}
