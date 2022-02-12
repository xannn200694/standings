<?php

namespace App\Application\UseCase\CreateChampionship;


use App\Application\UseCase;
use App\Application\UseCasePresenter;
use App\Application\UseCaseRequest;
use App\Domain\Entity\Championship\Championship;
use App\Domain\Entity\Championship\ChampionshipRepository;

final class CreateChampionshipUseCase implements UseCase
{
    private ChampionshipRepository $championships;

    public function __construct(ChampionshipRepository $championships)
    {
        $this->championships = $championships;
    }

    public function execute(?UseCaseRequest $request, UseCasePresenter $presenter): void
    {
        $championshipTitle = $this->generateTitle();
        $championship = new Championship($championshipTitle);

        $this->championships->add($championship);
        $this->championships->save();

        $presenter->addResult(
            new CreateChampionshipResult($championship)
        );

    }

    private function generateTitle(): string
    {
        return sprintf(
            'Championship #%s',
            microtime()
        );
    }
}