<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MatieresRepository")
 */
class Matieres
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
    private $codmat;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appartenir", mappedBy="matieres")
     */
    private $appartenirs;

    public function __construct()
    {
        $this->appartenirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodmat(): ?string
    {
        return $this->codmat;
    }

    public function setCodmat(string $codmat): self
    {
        $this->codmat = $codmat;

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
            $appartenir->setMatieres($this);
        }

        return $this;
    }

    public function removeAppartenir(Appartenir $appartenir): self
    {
        if ($this->appartenirs->contains($appartenir)) {
            $this->appartenirs->removeElement($appartenir);
            // set the owning side to null (unless already changed)
            if ($appartenir->getMatieres() === $this) {
                $appartenir->setMatieres(null);
            }
        }

        return $this;
    }
}
