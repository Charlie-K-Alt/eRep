<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\NiveauxRepository")
 */
class Niveaux
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscriptions", mappedBy="niveau")
     */
    private $inscriptions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appartenir", mappedBy="niveaux")
     */
    private $appartenirs;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->appartenirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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
            $inscription->setNiveau($this);
        }

        return $this;
    }

    public function removeInscription(Inscriptions $inscription): self
    {
        if ($this->inscriptions->contains($inscription)) {
            $this->inscriptions->removeElement($inscription);
            // set the owning side to null (unless already changed)
            if ($inscription->getNiveau() === $this) {
                $inscription->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Appartenir[]
     */
    public function getAppartenirs(): Collection
    {
        return $this->appartenirs;
    }

    public function addAppartenir(Appartenir $appartenir): self
    {
        if (!$this->appartenirs->contains($appartenir)) {
            $this->appartenirs[] = $appartenir;
            $appartenir->setNiveaux($this);
        }

        return $this;
    }

    public function removeAppartenir(Appartenir $appartenir): self
    {
        if ($this->appartenirs->contains($appartenir)) {
            $this->appartenirs->removeElement($appartenir);
            // set the owning side to null (unless already changed)
            if ($appartenir->getNiveaux() === $this) {
                $appartenir->setNiveaux(null);
            }
        }

        return $this;
    }
    public function __toString() //Configurer Niveau dans Inscription
    {
      return  $this->libelle;
    }
}
