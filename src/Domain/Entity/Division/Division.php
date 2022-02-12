<?php

namespace App\Domain\Entity\Division;

use App\Domain\Entity\Championship\Championship;
use App\Domain\Entity\Team\Team;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;

class Division
{
    private int $id;
    private Championship $championship;
    private string $title;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    /**
     * @var Collection| Team[]
    */
    private Collection $teams;

    /**
     * @var Collection|DivisionGame[]
    */
    private Collection $games;

    public function __construct(Championship $championship, string $title)
    {
        $this->championship = $championship;
        $this->title = $title;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
        $this->teams = new ArrayCollection();
        $this->games = new ArrayCollection();
    }

    #region getters
    public function id(): int
    {
        return $this->id;
    }

    public function championship(): Championship
    {
        return $this->championship;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }
    #endregion

    #region relations
    /**
     * @return DivisionGame[]| PersistentCollection
    */
    public function games(): Collection
    {
        return $this->games;
    }
    #endregion

    /**
     * @return Team[]|PersistentCollection
    */
    public function teams(): Collection
    {
        return $this->teams;
    }
}