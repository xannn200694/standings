<?php

namespace App\Application\Service\DivisionPresenter;


use App\Domain\Entity\Division\Division;
use App\Domain\Entity\Division\Score;

final class DivisionPresenterFactory
{
    public function create(Division $division): DivisionPresenter
    {
        $matrix = new DivisionPresenter();

        foreach ($division->games() as $game) {
            $matrix->add(
                $game->firstTeam()->id(),
                $game->secondTeam()->id(),
                new Score(
                    $game->firstTeamScore(),
                    $game->secondTeamScore()
                )
            );

            $matrix->add(
                $game->secondTeam()->id(),
                $game->firstTeam()->id(),
                new Score(
                    $game->secondTeamScore(),
                    $game->firstTeamScore()
                )
            );
        }

        return $matrix;
    }
}