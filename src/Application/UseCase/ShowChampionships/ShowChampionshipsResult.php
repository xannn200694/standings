<?php

namespace App\Application\UseCase\ShowChampionships;


use App\Application\Service\DivisionPresenter\DivisionPresenterFactory;
use App\Application\Service\PlayoffPresenter\PlayoffPresenter;
use App\Application\UseCaseResult;
use App\Domain\Entity\Championship\Championship;
use Doctrine\Common\Collections\Collection;

final class ShowChampionshipsResult implements UseCaseResult
{
    private array $championships;

    public function __construct(array $championships)
    {
        $this->championships = $championships;
    }

    public function toArray(): array
    {
        return [
            'championships' => $this->championships,
        ];
    }
}