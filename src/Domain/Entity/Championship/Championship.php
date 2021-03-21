<?php

namespace App\Domain\Entity\Championship;

use App\Domain\Entity\Division\Division;
use App\Domain\Entity\Playoff\Playoff;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;

class Championship
{
    private int $id;
    private string $title;
    private ChampionshipStatus $status;
    /**
     * @var Collection|Division[]
    */
    private Collection $divisions;
    private ?Playoff $playoff;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    public function __construct(string $title)
    {
        $this->title = $title;
        $this->status = ChampionshipStatus::NEW();
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    #region getters
    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function status(): ChampionshipStatus
    {
        return $this->status;
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

    public function divisionCreated(): void
    {
        $this->status = ChampionshipStatus::DIVISION_CREATED();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function divisionFinished(): void
    {
        $this->status = ChampionshipStatus::DIVISION_FINISHED();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function playoffCreated(): void
    {
        $this->status = ChampionshipStatus::PLAYOFF_CREATED();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function finished(): void
    {
        $this->status = ChampionshipStatus::FINISHED();
        $this->updatedAt = new DateTimeImmutable();
    }

    /**
     * @return Collection|Division[]
    */
    public function divisions()
    {
        return $this->divisions;
    }

    public function addDivision(Division $division)
    {
        if (!$this->divisions->contains($division)) {
            $this->divisions->add($division);
        }
    }

    public function playoff(): ?Playoff
    {
        return $this->playoff;
    }
}