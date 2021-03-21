<?php

namespace App\Domain\Service\Factory\Division;


use App\Domain\Entity\Championship\Championship;
use App\Domain\Entity\Division\Division;
use App\Domain\Entity\Division\DivisionRepository;
use App\Domain\Service\Factory\TeamsFactory;

final class DivisionFactory
{
    private DivisionGamesFactory $gamesFactory;
    private TeamsFactory $teamsFactory;
    private DivisionRepository $divisions;

    public function __construct(
        DivisionRepository $divisions,
        DivisionGamesFactory $gamesFactory,
        TeamsFactory $teamsFactory
    ) {
        $this->teamsFactory = $teamsFactory;
        $this->gamesFactory = $gamesFactory;
        $this->divisions = $divisions;
    }

    public function create(Championship $championship, string $title): void
    {
        $division = new Division($championship, $title);
        $this->divisions->add($division);

        $this->teamsFactory->create($division);
        $this->gamesFactory->create($division);
    }
}