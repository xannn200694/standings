<?php

namespace App\Domain\Entity\Playoff;


use App\Domain\Entity\Championship\Championship;
use App\Domain\Entity\Team\Team;
use Doctrine\Common\Collections\Collection;

final class Playoff
{
    private int $id;
    private Championship $championship;
    private PlayoffStep $step;
    private $matches;
    private ?Team $winner = null;

    public function __construct(Championship $championship)
    {
        $this->championship = $championship;
        $this->step = PlayoffStep::ONE_THIRD_FINAL();
    }

    public function id(): int
    {
        return $this->id;
    }

    public function championship(): Championship
    {
        return $this->championship;
    }

    /**
     * @return PlayoffMatch[]|Collection
    */
    public function matches(): Collection
    {
        return $this->matches;
    }

    public function winner(): ?Team
    {
        return $this->winner;
    }

    public function finish(Team $winner): void
    {
        $this->winner = $winner;
        $this->championship->finished();
    }

    public function step(): PlayoffStep
    {
        return $this->step;
    }

    public function nextStep(): void
    {
        $availableSteps = PlayoffStep::values();
        $currentStep = $this->step()->getKey();

        while(key($availableSteps) !== $currentStep) {
            next($availableSteps);
        };

        $this->step = next($availableSteps);
    }
}
