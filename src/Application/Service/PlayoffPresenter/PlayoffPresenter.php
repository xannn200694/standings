<?php


namespace App\Application\Service\PlayoffPresenter;


use App\Domain\Entity\Playoff\PlayoffMatch;
use App\Domain\Entity\Team\Team;

final class PlayoffPresenter
{
    /**
     * @var PlayoffMatch[]
     */
    private array $oneThirdFinal;

    /**
     * @var PlayoffMatch[]
    */
    private array $semiFinal;

    /**
     * @var PlayoffMatch[]
     */
    private array $final;

    private ?Team $winner;

    public function __construct(array $oneThirdFinal, array $semiFinal, array $final, ?Team $winner = null)
    {
        $this->oneThirdFinal = $oneThirdFinal;
        $this->semiFinal = $semiFinal;
        $this->final = $final;
        $this->winner = $winner;
    }

    public function oneThirdFinal(): array
    {
        return $this->oneThirdFinal;
    }

    public function semiFinal(): array
    {
        return $this->semiFinal;
    }

    public function final(): array
    {
        return $this->final;
    }

    /**
     * @return  PlayoffMatch[]
     */
    public function result(): array
    {
        return array_merge(
            $this->oneThirdFinal,
            $this->semiFinal,
            $this->final
        );
    }

    public function winner(): ?Team
    {
        return $this->winner;
    }
}