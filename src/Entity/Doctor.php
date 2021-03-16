<?php

namespace App\Entity;

use App\Repository\DoctorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DoctorRepository::class)
 */
class Doctor
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
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $lundi;

    /**
     * @ORM\Column(type="integer")
     */
    private $mardi;

    /**
     * @ORM\Column(type="integer")
     */
    private $mercredi;

    /**
     * @ORM\Column(type="integer")
     */
    private $jeudi;

    /**
     * @ORM\Column(type="integer")
     */
    private $vendredi;

    /**
     * @ORM\Column(type="integer")
     */
    private $samedi;

    /**
     * @ORM\Column(type="integer")
     */
    private $dimanche;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function getLundi(): ?int
    {
        return $this->lundi;
    }

    public function getMardi(): ?int
    {
        return $this->mardi;
    }

    public function getMercredi(): ?int
    {
        return $this->mercredi;
    }

    public function getJeudi(): ?int
    {
        return $this->jeudi;
    }

    public function getVendredi(): ?int
    {
        return $this->vendredi;
    }

    public function getSamedi(): ?int
    {
        return $this->samedi;
    }

    public function getDimanche(): ?int
    {
        return $this->dimanche;
    }


}
