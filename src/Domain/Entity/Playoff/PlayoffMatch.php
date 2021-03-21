<?php


namespace App\Domain\Entity\Playoff;


use App\Domain\Entity\Team\Team;

final class PlayoffMatch
{
    private int $id;
    private Playoff $playoff;
    private Team $firstTeam;
    private Team $secondTeam;
    private PlayoffMatchStep $step;
    private ?Team $winner;
    private int $firstTeamScore;
    private int $secondTeamScore;

    public function __construct(
        Playoff $playoff,
        Team $firstTeam,
        Team $secondTeam,
        PlayoffMatchStep $step
    ) {
        $this->playoff = $playoff;
        $this->firstTeam = $firstTeam;
        $this->secondTeam = $secondTeam;
        $this->step = $step;
        $this->winner = null;
        $this->firstTeamScore = 0;
        $this->secondTeamScore = 0;
    }

    public function playoff(): Playoff
    {
        return $this->playoff;
    }

    public function firstTeam(): Team
    {
        return $this->firstTeam;
    }

    public function secondTeam(): Team
    {
        return $this->secondTeam;
    }

    public function step(): PlayoffMatchStep
    {
        return $this->step;
    }

    public function winner(): ?Team
    {
        return $this->winner;
    }

    public function firstTeamScore(): int
    {
        return $this->firstTeamScore;
    }

    public function secondTeamScore(): int
    {
        return $this->secondTeamScore;
    }

    public function play(): void
    {
        //TODO: need think about the algorithm of the game so that there are no matches with a draw
        $this->firstTeamScore = rand(0,3);
        $this->secondTeamScore = rand(0,3);
        $this->winner = $this->firstTeamScore > $this->secondTeamScore ? $this->firstTeam : $this->secondTeam;
    }
}