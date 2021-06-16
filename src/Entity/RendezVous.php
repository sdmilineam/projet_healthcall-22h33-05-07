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
     * @ORM\Column(type="string", length=255)
     */
    private $DateTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Statue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Rdvfor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTime(): ?string
    {
        return $this->DateTime;
    }

    public function setDateTime(string $DateTime): self
    {
        $this->DateTime = $DateTime;

        return $this;
    }

    public function getStatue(): ?string
    {
        return $this->Statue;
    }

    public function setStatue(string $Statue): self
    {
        $this->Statue = $Statue;

        return $this;
    }

    public function getRdvfor(): ?string
    {
        return $this->Rdvfor;
    }

    public function setRdvfor(string $Rdvfor): self
    {
        $this->Rdvfor = $Rdvfor;

        return $this;
    }
}
