<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, \Serializable
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
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=Memoire::class, mappedBy="user")
     */
    private $memoires;


    public function __construct()
    {
        $this->memoires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }


    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    public function getPassword(): ?string
    {
        return $this->password;
    }

    
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function getSalt()
    {
        return null;
    }

    
    public function getUsername()
    {
    }

   
    public function eraseCredentials()
    {
    }

    public function serialize()
    {
        return serialize([
           $this->id,
           $this->email,
           $this->password,
           $this->roles
        ]);
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->email,
            $this->password,
            $this->roles
            ) = unserialize($serialized, ['allowed_class' => false]);
    }

    /**
     * @return Collection|Memoire[]
     */
    public function getMemoires(): Collection
    {
        return $this->memoires;
    }

    public function addMemoire(Memoire $memoire): self
    {
        if (!$this->memoires->contains($memoire)) {
            $this->memoires[] = $memoire;
            $memoire->setUser($this);
        }

        return $this;
    }

    public function removeMemoire(Memoire $memoire): self
    {
        if ($this->memoires->removeElement($memoire)) {
            // set the owning side to null (unless already changed)
            if ($memoire->getUser() === $this) {
                $memoire->setUser(null);
            }
        }

        return $this;
    }
}
