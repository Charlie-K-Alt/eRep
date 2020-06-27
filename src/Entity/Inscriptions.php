<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionsRepository")
 */
class Inscriptions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateins;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $frais;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Apprenants", inversedBy="inscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $apprenants;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveaux", inversedBy="inscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $niveau;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateurs", inversedBy="inscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateurs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateins(): ?\DateTimeInterface
    {
        return $this->dateins;
    }

    public function setDateins(\DateTimeInterface $dateins): self
    {
        $this->dateins = $dateins;

        return $this;
    }

    public function getFrais(): ?string
    {
        return $this->frais;
    }

    public function setFrais(string $frais): self
    {
        $this->frais = $frais;

        return $this;
    }

    public function getApprenants(): ?Apprenants
    {
        return $this->apprenants;
    }

    public function setApprenants(?Apprenants $apprenants): self
    {
        $this->apprenants = $apprenants;

        return $this;
    }

    public function getNiveau(): ?Niveaux
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveaux $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getUtilisateurs(): ?Utilisateurs
    {
        return $this->utilisateurs;
    }

    public function setUtilisateurs(?Utilisateurs $utilisateurs): self
    {
        $this->utilisateurs = $utilisateurs;

        return $this;
    }
}
