<?php

namespace App\Entity;

use App\Repository\SejourRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SejourRepository::class)
 */
class Sejour
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $debutsejour;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $finsejour;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idpatient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebutsejour(): ?\DateTimeInterface
    {
        return $this->debutsejour;
    }

    public function setDebutsejour(?\DateTimeInterface $debutsejour): self
    {
        $this->debutsejour = $debutsejour;

        return $this;
    }

    public function getFinsejour(): ?\DateTimeInterface
    {
        return $this->finsejour;
    }

    public function setFinsejour(?\DateTimeInterface $finsejour): self
    {
        $this->finsejour = $finsejour;

        return $this;
    }

    public function getIdpatient(): ?int
    {
        return $this->idpatient;
    }

    public function setIdpatient(?int $idpatient): self
    {
        $this->idpatient = $idpatient;

        return $this;
    }
}
