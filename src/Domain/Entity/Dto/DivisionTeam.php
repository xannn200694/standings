<?php

namespace App\Domain\Entity\Dto;


use App\Domain\Entity\Team\Team;

final class DivisionTeam
{
    private Team $team;
    private int $score;

    public function __construct(Team $team, int $score)
    {
        $this->team = $team;
        $this->score = $score;
    }

    public function team(): Team
    {
        return $this->team;
    }

    public function score(): int
    {
        return $this->score;
    }

    public function addScore(int $score): void
    {
        $this->score += $score;
    }
}