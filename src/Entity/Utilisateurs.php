<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateursRepository")
 */
class Utilisateurs implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenoms;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $droit;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscriptions", mappedBy="utilisateurs")
     */
    private $inscriptions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Repetiteur", mappedBy="utilisateurs")
     */
    private $repetiteurs;

    public $roles;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->repetiteurs = new ArrayCollection();
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

    public function getPrenoms(): ?string
    {
        return $this->prenoms;
    }

    public function setPrenoms(string $prenoms): self
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDroit(): ?string
    {
        return $this->droit;
    }

    public function setDroit(string $droit): self
    {
        $this->droit = $droit;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Inscriptions[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscriptions $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setUtilisateurs($this);
        }

        return $this;
    }

    public function removeInscription(Inscriptions $inscription): self
    {
        if ($this->inscriptions->contains($inscription)) {
            $this->inscriptions->removeElement($inscription);
            // set the owning side to null (unless already changed)
            if ($inscription->getUtilisateurs() === $this) {
                $inscription->setUtilisateurs(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Repetiteur[]
     */
    public function getRepetiteurs(): Collection
    {
        return $this->repetiteurs;
    }

    public function addRepetiteur(Repetiteur $repetiteur): self
    {
        if (!$this->repetiteurs->contains($repetiteur)) {
            $this->repetiteurs[] = $repetiteur;
            $repetiteur->setUtilisateurs($this);
        }

        return $this;
    }

    public function removeRepetiteur(Repetiteur $repetiteur): self
    {
        if ($this->repetiteurs->contains($repetiteur)) {
            $this->repetiteurs->removeElement($repetiteur);
            // set the owning side to null (unless already changed)
            if ($repetiteur->getUtilisateurs() === $this) {
                $repetiteur->setUtilisateurs(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        // recupère l'id de l'utilisateur dans repetiteur
        return $this->nom." ".$this->prenoms;
    }

    public function getUsername()
    {
        return $this->getPrenoms() .' '.$this->getNom();
    }
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
    public function getRoles()
    {

        // TODO: Implement getRoles() method.
        return $roles=["ROLE_ADMIN"];
    }
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
