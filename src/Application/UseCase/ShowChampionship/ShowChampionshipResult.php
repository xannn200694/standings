<?php

namespace App\Application\UseCase\ShowChampionship;


use App\Application\Service\DivisionPresenter\DivisionPresenterFactory;
use App\Application\Service\PlayoffPresenter\PlayoffPresenter;
use App\Application\UseCaseResult;
use App\Domain\Entity\Championship\Championship;

final class ShowChampionshipResult implements UseCaseResult
{
    private Championship $championship;
    private ?PlayoffPresenter $playoffPresenter;

    public function __construct(Championship $championship, ?PlayoffPresenter $playoffPresenter)
    {
        $this->championship = $championship;
        $this->playoffPresenter = $playoffPresenter;
    }

    public function toArray(): array
    {
        return [
            'championship' => $this->championship,
            'matrixFactory' => new DivisionPresenterFactory(),
            'playoffPresenter' => $this->playoffPresenter
        ];
    }
}