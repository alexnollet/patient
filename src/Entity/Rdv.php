<?php

namespace App\Entity;

use App\Repository\RdvRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RdvRepository::class)
 */
class Rdv
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
    private $userid;

    /**
     * @ORM\Column(type="integer")
     */
    private $docteurid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $jour;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $Userid): self
    {
        $this->userid = $Userid;

        return $this;
    }

    public function getDocteurid(): ?int
    {
        return $this->docteurid;
    }

    public function setDocteurid(int $docteurid): self
    {
        $this->docteurid = $docteurid;

        return $this;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

}
