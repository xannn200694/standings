<?php

namespace App\Application\UseCase\ShowChampionships;


use App\Application\Service\PlayoffPresenter\PlayoffPresenterFactory;
use App\Application\UseCase;
use App\Application\UseCasePresenter;
use App\Application\UseCaseRequest;
use App\Domain\Entity\Championship\ChampionshipRepository;

final class ShowChampionshipsUseCase implements UseCase
{
    private ChampionshipRepository $championships;

    public function __construct(ChampionshipRepository $championships)
    {
        $this->championships = $championships;
    }

    public function execute(UseCaseRequest $request, UseCasePresenter $presenter): void
    {
        $championships = $this->championships->all();

        $result = new ShowChampionshipsResult($championships);

        $presenter->addResult($result);
    }
}