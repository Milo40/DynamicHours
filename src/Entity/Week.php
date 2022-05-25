<?php

namespace App\Entity;

use App\Repository\WeekRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeekRepository::class)]
class Week
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $start;

    #[ORM\Column(type: 'date')]
    private $end;

    #[ORM\Column(type: 'integer')]
    private $opening_hour;

    #[ORM\Column(type: 'integer')]
    private $opening_min;

    #[ORM\Column(type: 'integer')]
    private $time_interval;

    #[ORM\Column(type: 'integer')]
    private $closing_hour;

    #[ORM\Column(type: 'integer')]
    private $closing_min;

    #[ORM\OneToMany(mappedBy: 'week_ID', targetEntity: Event::class)]
    private $events;

    #[ORM\Column(type: 'boolean')]
    private $is_holiday;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOpeningHour(): ?string
    {
        return $this->opening_hour;
    }

    public function setOpeningHour(string $opening_hour): self
    {
        $this->opening_hour = $opening_hour;

        return $this;
    }

    public function getOpeningMin(): ?int
    {
        return $this->opening_min;
    }

    public function setOpeningMin(int $opening_min): self
    {
        $this->opening_min = $opening_min;

        return $this;
    }

    public function getTimeInterval(): ?int
    {
        return $this->time_interval;
    }

    public function setTimeInterval(int $time_interval): self
    {
        $this->time_interval = $time_interval;

        return $this;
    }

    public function getClosingHour(): ?int
    {
        return $this->closing_hour;
    }

    public function setClosingHour(int $closing_hour): self
    {
        $this->closing_hour = $closing_hour;

        return $this;
    }

    public function getClosingMin(): ?int
    {
        return $this->closing_min;
    }

    public function setClosingMin(int $closing_min): self
    {
        $this->closing_min = $closing_min;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setWeekID($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getWeekID() === $this) {
                $event->setWeekID(null);
            }
        }

        return $this;
    }

    public function isIsHoliday(): ?bool
    {
        return $this->is_holiday;
    }

    public function setIsHoliday(bool $is_holiday): self
    {
        $this->is_holiday = $is_holiday;

        return $this;
    }
}
