<?php

namespace App\Entity;

use App\Repository\LitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LitRepository::class)
 */
class Lit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $disponibilite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idchambre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(?bool $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getIdchambre(): ?int
    {
        return $this->idchambre;
    }

    public function setIdchambre(?int $idchambre): self
    {
        $this->idchambre = $idchambre;

        return $this;
    }
}
