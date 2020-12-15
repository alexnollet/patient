<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServicesRepository::class)
 */
class Services
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomservice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomservice(): ?string
    {
        return $this->nomservice;
    }

    public function setNomservice(?string $nomservice): self
    {
        $this->nomservice = $nomservice;

        return $this;
    }
}
