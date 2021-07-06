<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"Username"}, message="There is already an account with this Username")
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks
 */
class User implements UserInterface, \Serializable, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $Username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;
    // /**
    //  * @ORM\ManyToOne(targetEntity=Specialite::class, inversedBy="nom_specialité" ,)
    //  * @ORM\Column(type="string", length=255, nullable=true)
    //  */
    // private $Pro;

    // /**
    //  * @Vich\UploadableField(mapping="image", fileNameProperty="image")
    //  * @ORM\ManyToOne(targetEntity=User::class, inversedBy="users" )
    //  * @ORM\Column(type="string", length=255, nullable=true)
    //  *
    //  * @var null|File
    //  */
    // private $ImageFile;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="ImageFile")
     */
    private $users;

    // /**
    //  * @ORM\Column(type="string", length=255, nullable=true)
    //  */
    // private $Image;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->Email,
            $this->password,
            $this->Nom,
            $this->Prenom,
            $this->Username,
            $this->Age,
            $this->telephone,
            $this->adresse,
        ]);
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->Email,
            $this->password,
            $this->Nom,
            $this->Prenom,
            $this->Username,
            $this->Age,
            $this->telephone,
            $this->adresse) = unserialize($serialized);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->Username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->Age;
    }

    public function setAge(string $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    // public function getPro(): ?Specialite
    // {
    //     return $this->Pro;
    // }

    // public function setPro(?Specialite $Pro): self
    // {
    //     $this->Pro = $Pro;

    //     return $this;
    // }

    // public function getImageFile(): ?self
    // {
    //     return $this->ImageFile;
    // }

    // public function setImageFile(File $image = null)
    // {
    //     $this->imageFile = $image;

    //     if ($image) {
    //         $this->updatedAt = new \DateTime('now');
    //     }
    // }

    /**
     * @return Collection|self[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(self $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setImageFile($this);
        }

        return $this;
    }

    public function removeUser(self $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getImageFile() === $this) {
                $user->setImageFile(null);
            }
        }

        return $this;
    }

    // public function getImage(): ?string
    // {
    //     return $this->Image;
    // }

    // public function setImage(?string $Image): self
    // {
    //     $this->Image = $Image;

    //     return $this;
    // }

    /**
     * Get the value of telephone.
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone.
     *
     * @param mixed $telephone
     *
     * @return self
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get the value of adresse.
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse.
     *
     * @param mixed $adresse
     *
     * @return self
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }
}
