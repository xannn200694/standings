<?php


namespace App\Domain\Service\DivisionTeamCollection;


use App\Domain\Entity\Dto\DivisionTeam;
use App\Domain\Entity\Team\Team;

final class DivisionTeamCollection
{
    /**
     * @var DivisionTeam[]
    */
    private array $teams = [];

    public function add(Team $team, int $score)
    {
        if (isset($this->teams[$team->id()])) {
            $this->teams[$team->id()]->addScore($score);
        } else {
            $this->teams[$team->id()] = new DivisionTeam($team, $score);
        }
    }

    /**
     * @return DivisionTeam[]
    */
    public function takeWinners(): array
    {
        $teams = $this->teams;

        usort($teams, function (DivisionTeam $prev, DivisionTeam $next) {
            return $prev->score() < $next->score();
        });

        return array_slice($teams, 1,4);
    }
}