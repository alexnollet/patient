<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idservice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nblit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdservice(): ?int
    {
        return $this->idservice;
    }

    public function setIdservice(int $idservice): self
    {
        $this->idservice = $idservice;

        return $this;
    }

    public function getNblit(): ?int
    {
        return $this->nblit;
    }

    public function setNblit(?int $nblit): self
    {
        $this->nblit = $nblit;

        return $this;
    }
}
