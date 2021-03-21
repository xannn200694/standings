<?php

namespace App\Domain\Entity\Division;

use App\Domain\Entity\Team\Team;
use DateTimeImmutable;

final class DivisionGame
{
    private int $id;
    private Division $division;
    private Team $firstTeam;
    private Team $secondTeam;
    private int $firstTeamScore;
    private int $secondTeamScore;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    public function __construct(Division $division, Team $firstTeam, Team $secondTeam)
    {
        $this->division = $division;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
        $this->firstTeam = $firstTeam;
        $this->secondTeam = $secondTeam;
        $this->firstTeamScore = 0;
        $this->secondTeamScore = 0;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function division(): Division
    {
        return $this->division;
    }

    public function firstTeamScore(): int
    {
        return $this->firstTeamScore;
    }

    public function secondTeamScore(): int
    {
        return $this->secondTeamScore;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function firstTeam(): Team
    {
        return $this->firstTeam;
    }

    public function secondTeam(): Team
    {
        return $this->secondTeam;
    }

    public function play(int $firstTeamScore, int $secondTeamScore): void
    {
        $this->firstTeamScore = $firstTeamScore;
        $this->secondTeamScore = $secondTeamScore;
        $this->updatedAt = new DateTimeImmutable();
    }
}