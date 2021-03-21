<?php


namespace App\Application\Service\GamePlay;


use App\Application\Service\PlayoffMapper;
use App\Domain\Entity\Playoff\Playoff;
use App\Domain\Entity\Playoff\PlayoffMatch;
use App\Domain\Entity\Playoff\PlayoffMatchRepository;
use App\Domain\Entity\Playoff\PlayoffRepository;
use App\Domain\Entity\Playoff\PlayoffStep;

final class PlayoffGamePlay
{
    private PlayoffMatchRepository $matches;
    private PlayoffMapper $playoffMapper;
    private PlayoffRepository $playoffs;

    public function __construct(
        PlayoffMatchRepository $matches,
        PlayoffMapper $playoffMapper,
        PlayoffRepository $playoffs
    ) {
        $this->matches = $matches;
        $this->playoffMapper = $playoffMapper;
        $this->playoffs = $playoffs;
    }

    public function run(Playoff $playoff, PlayoffStep $currentStep): void
    {
        $currentStepMatches = $this->playoffMapper->get($currentStep);
        $matches = $playoff->matches()->toArray();

        /**
         * @var PlayoffMatch[] $finishedMatches
        */
        $finishedMatches = array_filter($matches, function (PlayoffMatch $match) use ($currentStepMatches) {
            return $match->step()->equals($currentStepMatches);
        });

        foreach ($finishedMatches as $match) {
            $match->play();
            $this->matches->update($match);


        }
        if ($playoff->step()->isFinish()) {
            $finalMatch = array_shift($finishedMatches);

            $playoff->finish($finalMatch->winner());
            return;
        }

        $this->makeNewStep($playoff, $finishedMatches);
    }

    private function makeNewStep(Playoff $playoff, array $matches): void
    {
        $nextMatchesStep = $this->playoffMapper->get($playoff->step());
        $matchPairs = array_chunk($matches,2);
        foreach ($matchPairs as $pair) {
            $newMatch = new PlayoffMatch(
                $playoff,
                $pair[0]->winner(),
                $pair[1]->winner(),
                $nextMatchesStep
            );

            $this->matches->add($newMatch);
        }

        $this->matches->save();
    }
}