<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idlit;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     */
    private $telpatient;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $adressepatient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdlit(): ?int
    {
        return $this->idlit;
    }

    public function setIdlit(?int $idlit): self
    {
        $this->idlit = $idlit;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelpatient(): ?string
    {
        return $this->telpatient;
    }

    public function setTelpatient(?string $telpatient): self
    {
        $this->telpatient = $telpatient;

        return $this;
    }

    public function getAdressepatient(): ?string
    {
        return $this->adressepatient;
    }

    public function setAdressepatient(?string $adressepatient): self
    {
        $this->adressepatient = $adressepatient;

        return $this;
    }
}
