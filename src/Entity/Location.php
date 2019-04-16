<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 */
class Location
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="location")
     */
    private $location_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $breedtegraad;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lengtegraad;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    public function __construct()
    {
        $this->location_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|reservation[]
     */
    public function getLocationId(): Collection
    {
        return $this->location_id;
    }

    public function addLocationId(reservation $locationId): self
    {
        if (!$this->location_id->contains($locationId)) {
            $this->location_id[] = $locationId;
            $locationId->setLocation($this);
        }

        return $this;
    }

    public function removeLocationId(reservation $locationId): self
    {
        if ($this->location_id->contains($locationId)) {
            $this->location_id->removeElement($locationId);
            // set the owning side to null (unless already changed)
            if ($locationId->getLocation() === $this) {
                $locationId->setLocation(null);
            }
        }

        return $this;
    }

    public function getBreedtegraad(): ?string
    {
        return $this->breedtegraad;
    }

    public function setBreedtegraad(string $breedtegraad): self
    {
        $this->breedtegraad = $breedtegraad;

        return $this;
    }

    public function getLengtegraad(): ?string
    {
        return $this->lengtegraad;
    }

    public function setLengtegraad(string $lengtegraad): self
    {
        $this->lengtegraad = $lengtegraad;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }
}
