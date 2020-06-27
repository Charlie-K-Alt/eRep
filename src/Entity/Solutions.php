<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SolutionsRepository")
 */
class Solutions
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
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Repetiteur", inversedBy="solutions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $repetiteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Exercices", inversedBy="solutions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $exercices;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRepetiteur(): ?Repetiteur
    {
        return $this->repetiteur;
    }

    public function setRepetiteur(?Repetiteur $repetiteur): self
    {
        $this->repetiteur = $repetiteur;

        return $this;
    }

    public function getExercices(): ?Exercices
    {
        return $this->exercices;
    }

    public function setExercices(?Exercices $exercices): self
    {
        $this->exercices = $exercices;

        return $this;
    }

}
