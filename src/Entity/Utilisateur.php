<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $motDePasse = null;

    #[ORM\Column(type: Types::JSON)]
    private array $role = [];

    #[ORM\Column]
    private ?\DateTime $dateInscription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    /**
     * @var Collection<int, Evenement>
     */
    #[ORM\ManyToMany(targetEntity: Evenement::class, mappedBy: 'participants')]
    private Collection $evenements;

    /**
     * @var Collection<int, RendezVous>
     */
    #[ORM\OneToMany(targetEntity: RendezVous::class, mappedBy: 'eleve')]
    private Collection $rendezVouses;

    /**
     * @var Collection<int, Message>
     */
    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'expediteur')]
    private Collection $messagesEnvoyes;

    /**
     * @var Collection<int, Message>
     */
    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'destinataire')]
    private Collection $messagesRecus;

    /**
     * @var Collection<int, ResultatQuiz>
     */
    #[ORM\OneToMany(targetEntity: ResultatQuiz::class, mappedBy: 'utilisateur')]
    private Collection $resultatQuizzes;

    /**
     * @var Collection<int, Filiere>
     */
    #[ORM\ManyToMany(targetEntity: Filiere::class, mappedBy: 'interesses')]
    private Collection $filieresInteret;

    /**
     * @var Collection<int, Avis>
     */
    #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'utilisateur')]
    private Collection $avis;

    /**
     * @var Collection<int, Orientation>
     */
    #[ORM\OneToMany(targetEntity: Orientation::class, mappedBy: 'utilisateur')]
    private Collection $orientations;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
        $this->rendezVouses = new ArrayCollection();
        $this->messagesEnvoyes = new ArrayCollection();
        $this->messagesRecus = new ArrayCollection();
        $this->resultatQuizzes = new ArrayCollection();
        $this->filieresInteret = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->orientations = new ArrayCollection();
        $this->role = ['ROLE_USER'];
        $this->dateInscription = new \DateTime();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): static
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getRole(): array
    {
        return $this->role;
    }

    public function setRole(array $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getDateInscription(): ?\DateTime
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTime $dateInscription): static
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): static
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements->add($evenement);
            $evenement->addParticipant($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): static
    {
        if ($this->evenements->removeElement($evenement)) {
            $evenement->removeParticipant($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, RendezVous>
     */
    public function getRendezVouses(): Collection
    {
        return $this->rendezVouses;
    }

    public function addRendezVouse(RendezVous $rendezVouse): static
    {
        if (!$this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses->add($rendezVouse);
            $rendezVouse->setEleve($this);
        }

        return $this;
    }

    public function removeRendezVouse(RendezVous $rendezVouse): static
    {
        if ($this->rendezVouses->removeElement($rendezVouse)) {
            // set the owning side to null (unless already changed)
            if ($rendezVouse->getEleve() === $this) {
                $rendezVouse->setEleve(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessagesEnvoyes(): Collection
    {
        return $this->messagesEnvoyes;
    }

    public function addMessagesEnvoye(Message $messagesEnvoye): static
    {
        if (!$this->messagesEnvoyes->contains($messagesEnvoye)) {
            $this->messagesEnvoyes->add($messagesEnvoye);
            $messagesEnvoye->setExpediteur($this);
        }

        return $this;
    }

    public function removeMessagesEnvoye(Message $messagesEnvoye): static
    {
        if ($this->messagesEnvoyes->removeElement($messagesEnvoye)) {
            // set the owning side to null (unless already changed)
            if ($messagesEnvoye->getExpediteur() === $this) {
                $messagesEnvoye->setExpediteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessagesRecus(): Collection
    {
        return $this->messagesRecus;
    }

    public function addMessagesRecu(Message $messagesRecu): static
    {
        if (!$this->messagesRecus->contains($messagesRecu)) {
            $this->messagesRecus->add($messagesRecu);
            $messagesRecu->setDestinataire($this);
        }

        return $this;
    }

    public function removeMessagesRecu(Message $messagesRecu): static
    {
        if ($this->messagesRecus->removeElement($messagesRecu)) {
            // set the owning side to null (unless already changed)
            if ($messagesRecu->getDestinataire() === $this) {
                $messagesRecu->setDestinataire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ResultatQuiz>
     */
    public function getResultatQuizzes(): Collection
    {
        return $this->resultatQuizzes;
    }

    public function addResultatQuiz(ResultatQuiz $resultatQuiz): static
    {
        if (!$this->resultatQuizzes->contains($resultatQuiz)) {
            $this->resultatQuizzes->add($resultatQuiz);
            $resultatQuiz->setUtilisateur($this);
        }

        return $this;
    }

    public function removeResultatQuiz(ResultatQuiz $resultatQuiz): static
    {
        if ($this->resultatQuizzes->removeElement($resultatQuiz)) {
            // set the owning side to null (unless already changed)
            if ($resultatQuiz->getUtilisateur() === $this) {
                $resultatQuiz->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Filiere>
     */
    public function getFilieresInteret(): Collection
    {
        return $this->filieresInteret;
    }

    public function addFilieresInteret(Filiere $filieresInteret): static
    {
        if (!$this->filieresInteret->contains($filieresInteret)) {
            $this->filieresInteret->add($filieresInteret);
            $filieresInteret->addInteresse($this);
        }

        return $this;
    }

    public function removeFilieresInteret(Filiere $filieresInteret): static
    {
        if ($this->filieresInteret->removeElement($filieresInteret)) {
            $filieresInteret->removeInteresse($this);
        }

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
            $avi->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getUtilisateur() === $this) {
                $avi->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Orientation>
     */
    public function getOrientations(): Collection
    {
        return $this->orientations;
    }

    public function addOrientation(Orientation $orientation): static
    {
        if (!$this->orientations->contains($orientation)) {
            $this->orientations->add($orientation);
            $orientation->setUtilisateur($this);
        }

        return $this;
    }

    public function removeOrientation(Orientation $orientation): static
    {
        if ($this->orientations->removeElement($orientation)) {
            // set the owning side to null (unless already changed)
            if ($orientation->getUtilisateur() === $this) {
                $orientation->setUtilisateur(null);
            }
        }

        return $this;
    }

    // Méthodes requises par UserInterface
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->role;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
        // Si vous stockez des données temporaires sensibles sur l'utilisateur, effacez-les ici
        // $this->plainPassword = null;
    }

    public function getPassword(): string
    {
        return $this->motDePasse;
    }
}
