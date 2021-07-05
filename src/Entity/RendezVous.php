<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RendezVousRepository::class)
 */
class RendezVous
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $Creat_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $Update_At;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link_rdv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCreatAt(): ?\DateTimeImmutable
    {
        return $this->Creat_at;
    }

    public function setCreatAt(\DateTimeImmutable $Creat_at): self
    {
        $this->Creat_at = $Creat_at;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->Update_At;
    }

    public function setUpdateAt(\DateTimeImmutable $Update_At): self
    {
        $this->Update_At = $Update_At;

        return $this;
    }

    public function getLinkRdv(): ?string
    {
        return $this->link_rdv;
    }

    public function setLinkRdv(string $link_rdv): self
    {
        $this->link_rdv = $link_rdv;

        return $this;
    }
}
