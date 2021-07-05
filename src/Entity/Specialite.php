<?php

namespace App\Entity;

use App\Repository\SpecialiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecialiteRepository::class)
 */
class Specialite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=user::class, mappedBy="Pro")
     */
    private $nom_specialité;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $Creat_At;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $Update_at;

    public function __construct()
    {
        $this->nom_specialité = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|user[]
     */
    public function getNomSpecialité(): Collection
    {
        return $this->nom_specialité;
    }

    public function addNomSpecialit(user $nomSpecialit): self
    {
        if (!$this->nom_specialité->contains($nomSpecialit)) {
            $this->nom_specialité[] = $nomSpecialit;
            $nomSpecialit->setPro($this);
        }

        return $this;
    }

    public function removeNomSpecialit(user $nomSpecialit): self
    {
        if ($this->nom_specialité->removeElement($nomSpecialit)) {
            // set the owning side to null (unless already changed)
            if ($nomSpecialit->getPro() === $this) {
                $nomSpecialit->setPro(null);
            }
        }

        return $this;
    }

    public function getCreatAt(): ?\DateTimeImmutable
    {
        return $this->Creat_At;
    }

    public function setCreatAt(\DateTimeImmutable $Creat_At): self
    {
        $this->Creat_At = $Creat_At;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->Update_at;
    }

    public function setUpdateAt(\DateTimeImmutable $Update_at): self
    {
        $this->Update_at = $Update_at;

        return $this;
    }
}
