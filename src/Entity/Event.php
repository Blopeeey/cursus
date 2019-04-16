<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="event")
     */
    private $event_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @ORM\Column(type="integer")
     */
    private $min_part;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_part;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    public function __construct()
    {
        $this->event_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|reservation[]
     */
    public function getEventId(): Collection
    {
        return $this->event_id;
    }

    public function addEventId(reservation $eventId): self
    {
        if (!$this->event_id->contains($eventId)) {
            $this->event_id[] = $eventId;
            $eventId->setEvent($this);
        }

        return $this;
    }

    public function removeEventId(reservation $eventId): self
    {
        if ($this->event_id->contains($eventId)) {
            $this->event_id->removeElement($eventId);
            // set the owning side to null (unless already changed)
            if ($eventId->getEvent() === $this) {
                $eventId->setEvent(null);
            }
        }

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getMinPart(): ?int
    {
        return $this->min_part;
    }

    public function setMinPart(int $min_part): self
    {
        $this->min_part = $min_part;

        return $this;
    }

    public function getMaxPart(): ?int
    {
        return $this->max_part;
    }

    public function setMaxPart(int $max_part): self
    {
        $this->max_part = $max_part;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
