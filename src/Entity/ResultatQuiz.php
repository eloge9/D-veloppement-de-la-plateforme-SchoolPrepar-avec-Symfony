<?php

namespace App\Entity;

use App\Repository\ResultatQuizRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultatQuizRepository::class)]
class ResultatQuiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $score = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $recommandation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $datePassage = null;

    #[ORM\ManyToOne(inversedBy: 'resultatQuizzes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'resultatQuizzes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Quiz $quiz = null;

    public function __construct()
    {
        $this->datePassage = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function getRecommandation(): ?string
    {
        return $this->recommandation;
    }

    public function setRecommandation(string $recommandation): static
    {
        $this->recommandation = $recommandation;

        return $this;
    }

    public function getDatePassage(): ?\DateTime
    {
        return $this->datePassage;
    }

    public function setDatePassage(\DateTime $datePassage): static
    {
        $this->datePassage = $datePassage;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): static
    {
        $this->quiz = $quiz;

        return $this;
    }
}
