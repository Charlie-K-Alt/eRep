<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
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
}
