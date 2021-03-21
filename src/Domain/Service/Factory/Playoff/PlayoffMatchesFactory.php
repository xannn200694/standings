<?php


namespace App\Domain\Service\Factory\Playoff;


use App\Domain\Entity\Division\Division;
use App\Domain\Entity\Playoff\Playoff;
use App\Domain\Entity\Playoff\PlayoffMatch;
use App\Domain\Entity\Playoff\PlayoffMatchRepository;
use App\Domain\Entity\Playoff\PlayoffMatchStep;
use App\Domain\Service\DivisionTeamCollection\DivisionTeamCollectionFactory;

final class PlayoffMatchesFactory
{
    private PlayoffMatchRepository $matches;
    private DivisionTeamCollectionFactory $teamCollectionFactory;

    public function __construct(PlayoffMatchRepository $matches, DivisionTeamCollectionFactory $teamCollectionFactory)
    {
        $this->matches = $matches;
        $this->teamCollectionFactory = $teamCollectionFactory;
    }

    public function create(Playoff $playoff, Division $divisionA, Division $divisionB)
    {
        $teamsA = $this->teamCollectionFactory->create($divisionA);
        $teamsB = $this->teamCollectionFactory->create($divisionB);

        $winnersA = $teamsA->takeWinners();
        $winnersB = $teamsB->takeWinners();
        for ($i=0,$j=3; $i < count($winnersA) && $j >= 0; $i++, $j--) {
            $playoffMatch = new PlayoffMatch(
                $playoff,
                $winnersA[$i]->team(),
                $winnersB[$j]->team(),
                PlayoffMatchStep::ONE_THIRD_FINAL()
            );
            $this->matches->add($playoffMatch);
        }

        $this->matches->save();
    }
}