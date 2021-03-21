<?php


namespace App\Domain\Service\Factory\Division;


use App\Domain\Entity\Division\Division;
use App\Domain\Entity\Division\DivisionGame;
use App\Domain\Entity\Division\DivisionGameRepository;
use App\Domain\Entity\Team\Team;

final class DivisionGamesFactory
{
    private DivisionGameRepository $games;

    public function __construct(DivisionGameRepository $games)
    {
        $this->games = $games;
    }

    public function create(Division $division): void
    {
        $excludedPairs = [];
        $teams = $division->teams();

        for ($i = 0; $i < count($teams); $i++) {
            for ($j = 0; $j < count($teams); $j++) {
                if ($this->isEqualsTeam($teams[$i], $teams[$j])) {
                    continue;
                }

                $pairsKey = $teams[$i]->name() . '-' . $teams[$j]->name();
                $pairsRevertedKey = $teams[$j]->name() . '-' . $teams[$i]->name();

                if (in_array($pairsKey, $excludedPairs) || in_array($pairsRevertedKey, $excludedPairs)) {
                    continue;
                }

                $game = new DivisionGame($division, $teams[$i], $teams[$j]);
                $this->games->add($game);

                $excludedPairs[] = $pairsRevertedKey;
            }
        }

        $this->games->save();
    }


    private function isEqualsTeam(Team $first, Team $second): bool
    {
        return $first === $second;
    }
}