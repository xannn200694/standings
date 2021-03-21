<?php

namespace App\Domain\Entity\Division;


final class Score
{
    private int $firstTeam;
    private int $secondTeam;

    public function __construct(int $firstTeam, int $secondTeam)
    {
        $this->firstTeam = $firstTeam;
        $this->secondTeam = $secondTeam;
    }

    public function firstTeam(): int
    {
        return $this->firstTeam;
    }

    public function secondTeam(): int
    {
        return $this->secondTeam;
    }

    public function toString(): string
    {
        return $this->firstTeam . ':' . $this->secondTeam;
    }
}