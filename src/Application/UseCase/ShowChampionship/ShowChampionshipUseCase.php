<?php

namespace App\Application\UseCase\ShowChampionship;


use App\Application\Service\PlayoffPresenter\PlayoffPresenterFactory;
use App\Application\UseCase;
use App\Application\UseCasePresenter;
use App\Application\UseCaseRequest;
use App\Domain\Entity\Championship\ChampionshipRepository;

final class ShowChampionshipUseCase implements UseCase
{
    private ChampionshipRepository $championships;
    private PlayoffPresenterFactory $playoffStandingPresenterFactory;

    public function __construct(
        ChampionshipRepository $championships,
        PlayoffPresenterFactory $playoffStandingPresenterFactory
    ) {
        $this->championships = $championships;
        $this->playoffStandingPresenterFactory = $playoffStandingPresenterFactory;
    }

    public function execute(?UseCaseRequest $request, UseCasePresenter $presenter): void
    {
        /**
         * @var ShowChampionshipRequest $request
         */
        $championship = $this->championships->findOrFail($request->id());
        $playoffPresenter = null;
        $playoff = $championship->playoff();
        if ($playoff) {
            $playoffPresenter = $this->playoffStandingPresenterFactory->create($playoff);
        }

        $result = new ShowChampionshipResult($championship, $playoffPresenter);

        $presenter->addResult($result);
    }
}