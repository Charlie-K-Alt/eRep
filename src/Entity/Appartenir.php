<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AppartenirRepository")
 */
class Appartenir
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matieres", inversedBy="appartenirs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matieres;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveaux", inversedBy="appartenirs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $niveaux;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatieres(): ?Matieres
    {
        return $this->matieres;
    }

    public function setMatieres(?Matieres $matieres): self
    {
        $this->matieres = $matieres;

        return $this;
    }

    public function getNiveaux(): ?Niveaux
    {
        return $this->niveaux;
    }

    public function setNiveaux(?Niveaux $niveaux): self
    {
        $this->niveaux = $niveaux;

        return $this;
    }
}
