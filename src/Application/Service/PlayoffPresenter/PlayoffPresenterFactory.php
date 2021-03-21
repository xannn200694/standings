<?php

namespace App\Application\Service\PlayoffPresenter;

use App\Domain\Entity\Playoff\Playoff;
use App\Domain\Entity\Playoff\PlayoffMatch;
use App\Domain\Entity\Playoff\PlayoffMatchRepository;

final class PlayoffPresenterFactory
{
    public function create(Playoff $playoff): PlayoffPresenter
    {
        $oneThirdFinal = [];
        $semiFinal = [];
        $final = [];

        foreach ($playoff->matches() as $match) {
            switch (true) {
                case $match->step()->isOneThirdFinal():
                    $oneThirdFinal[] = $match;
                    break;
                case $match->step()->isSemiFinal():
                    $semiFinal[] = $match;
                    break;
                case $match->step()->isFinal():
                    $final[] = $match;
                    break;
            }
        }

        return new PlayoffPresenter(
            $oneThirdFinal,
            $semiFinal,
            $final,
        );
    }
}