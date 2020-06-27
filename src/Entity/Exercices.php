<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ExercicesRepository")
 */
class Exercices
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $enonce;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Solutions", mappedBy="exercices")
     */
    private $solutions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Repetiteur", inversedBy="exercices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $repetiteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Situation", inversedBy="exercices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $situation;

    public function __construct()
    {
        $this->solutions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnonce(): ?string
    {
        return $this->enonce;
    }

    public function setEnonce(string $enonce): self
    {
        $this->enonce = $enonce;

        return $this;
    }

    /**
     * @return Collection|Solutions[]
     */
    public function getSolutions(): Collection
    {
        return $this->solutions;
    }

    public function addSolution(Solutions $solution): self
    {
        if (!$this->solutions->contains($solution)) {
            $this->solutions[] = $solution;
            $solution->setExercices($this);
        }

        return $this;
    }

    public function removeSolution(Solutions $solution): self
    {
        if ($this->solutions->contains($solution)) {
            $this->solutions->removeElement($solution);
            // set the owning side to null (unless already changed)
            if ($solution->getExercices() === $this) {
                $solution->setExercices(null);
            }
        }

        return $this;
    }

    public function getRepetiteur(): ?Repetiteur
    {
        return $this->repetiteur;
    }

    public function setRepetiteur(?Repetiteur $repetiteur): self
    {
        $this->repetiteur = $repetiteur;

        return $this;
    }

    public function getSituation(): ?Situation
    {
        return $this->situation;
    }

    public function setSituation(?Situation $situation): self
    {
        $this->situation = $situation;

        return $this;
    }
    public  function __toString()
    {
        // recupère l'id de Exercices dans solution
        return $this->enonce;
    }
}
