<?php


namespace App\Application\Service\GamePlay;


use App\Domain\Entity\Division\Division;
use App\Domain\Entity\Division\DivisionGameRepository;

final class DivisionGamePlay
{
    private DivisionGameRepository $games;

    public function __construct(DivisionGameRepository $games)
    {
        $this->games = $games;
    }

    public function run(Division $division): void
    {
        foreach ($division->games() as $game) {
            $game->play(rand(0,1), rand(0,1));
            $this->games->update($game);
        }
    }
}