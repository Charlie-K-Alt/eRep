<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SituationRepository")
 */
class Situation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $titreSa;

    /**
     * @ORM\Column(type="text")
     */
    private $contenuSa;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Exercices", mappedBy="situation")
     */
    private $exercices;

    public function __construct()
    {
        $this->exercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreSa(): ?string
    {
        return $this->titreSa;
    }

    public function setTitreSa(string $titreSa): self
    {
        $this->titreSa = $titreSa;

        return $this;
    }

    public function getContenuSa(): ?string
    {
        return $this->contenuSa;
    }

    public function setContenuSa(string $contenuSa): self
    {
        $this->contenuSa = $contenuSa;

        return $this;
    }

    /**
     * @return Collection|Exercices[]
     */
    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercices $exercice): self
    {
        if (!$this->exercices->contains($exercice)) {
            $this->exercices[] = $exercice;
            $exercice->setSituation($this);
        }

        return $this;
    }

    public function removeExercice(Exercices $exercice): self
    {
        if ($this->exercices->contains($exercice)) {
            $this->exercices->removeElement($exercice);
            // set the owning side to null (unless already changed)
            if ($exercice->getSituation() === $this) {
                $exercice->setSituation(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        // Récupère l'id de Situation dans Exercice
        return $this->titreSa;
    }
}
