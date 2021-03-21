<?php


namespace App\Domain\Service\DivisionTeamCollection;


use App\Domain\Entity\Division\Division;

final class DivisionTeamCollectionFactory
{
    public function create(Division $division): DivisionTeamCollection
    {
        $teams = new DivisionTeamCollection();

        foreach ($division->games() as $game) {
            $teams->add($game->firstTeam(), $game->firstTeamScore());
            $teams->add($game->secondTeam(), $game->secondTeamScore());
        }

        return $teams;
    }
}