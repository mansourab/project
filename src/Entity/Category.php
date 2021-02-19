<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
     * @ORM\ManyToMany(targetEntity=Memoire::class, mappedBy="categories")
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
            $memoire->addCategory($this);
        }

        return $this;
    }


    public function removeMemoire(Memoire $memoire): self
    {
        if ($this->memoires->removeElement($memoire)) {
            $memoire->removeCategory($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
    
}
