<?php

namespace App\Entity;

use App\Repository\MemoireOptionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MemoireOptionsRepository::class)
 */
class MemoireOptions
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Memoire::class, mappedBy="type")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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
            $memoire->setType($this);
        }

        return $this;
    }

    public function removeMemoire(Memoire $memoire): self
    {
        if ($this->memoires->removeElement($memoire)) {
            if ($memoire->getType() === $this) {
                $memoire->setType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
