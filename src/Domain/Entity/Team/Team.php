<?php

namespace App\Domain\Entity\Team;

use App\Domain\Entity\Division\Division;
use App\Domain\Entity\Division\DivisionGame;
use DateTimeImmutable;

class Team
{
    private int $id;
    private string $name;
    private Division $division;
    private ?DivisionGame $playAsFirstTeam;
    private ?DivisionGame $playAsSecondTeam;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    public function __construct(Division $division, string $name)
    {
        $this->name = $name;
        $this->division = $division;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function playAsFirstTeam(): ?DivisionGame
    {
        return $this->playAsFirstTeam;
    }

    public function playAsSecondTeam(): ?DivisionGame
    {
        return $this->playAsSecondTeam;
    }

    public function division(): Division
    {
        return $this->division;
    }
}