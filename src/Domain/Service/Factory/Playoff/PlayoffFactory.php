<?php


namespace App\Domain\Service\Factory\Playoff;


use App\Domain\Entity\Championship\Championship;
use App\Domain\Entity\Playoff\Playoff;
use App\Domain\Entity\Playoff\PlayoffRepository;

final class PlayoffFactory
{
    private PlayoffRepository $playoffs;
    private PlayoffMatchesFactory $matchesFactory;

    public function __construct(PlayoffRepository $playoffs, PlayoffMatchesFactory $matchesFactory)
    {
        $this->playoffs = $playoffs;
        $this->matchesFactory = $matchesFactory;
    }

    public function create(Championship $championship)
    {
        $playoff = new Playoff($championship);
        $this->playoffs->add($playoff);

        list($divisionA, $divisionB) = $championship->divisions();

        $this->matchesFactory->create($playoff, $divisionA, $divisionB);
    }
}