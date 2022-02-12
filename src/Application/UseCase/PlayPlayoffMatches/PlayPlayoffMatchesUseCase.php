<?php

namespace App\Application\UseCase\PlayPlayoffMatches;

use App\Application\Service\GamePlay\PlayoffGamePlay;
use App\Application\UseCase;
use App\Application\UseCasePresenter;
use App\Application\UseCaseRequest;
use App\Domain\Entity\Championship\ChampionshipRepository;
use App\Domain\Entity\Playoff\PlayoffRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

final class PlayPlayoffMatchesUseCase implements UseCase
{
    private EntityManagerInterface $entityManager;
    private PlayoffRepository $playoffs;
    private PlayoffGamePlay $gamePlay;
    private ChampionshipRepository $championships;

    public function __construct(
        EntityManagerInterface $entityManager,
        PlayoffRepository $playoffs,
        PlayoffGamePlay $gamePlay,
        ChampionshipRepository $championships
    ) {
        $this->entityManager = $entityManager;
        $this->playoffs = $playoffs;
        $this->gamePlay = $gamePlay;
        $this->championships = $championships;
    }

    public function execute(?UseCaseRequest $request, UseCasePresenter $presenter): void
    {
        /**
         * @var PlayPlayoffMatchesRequest $request
         */
        $playoff = $this->playoffs->findOrFail($request->id());

        try {
            $this->entityManager->beginTransaction();

            $currentStep = $playoff->step();
            $playoff->nextStep();

            $this->gamePlay->run($playoff, $currentStep);
            $this->playoffs->update($playoff);
            $this->playoffs->save();

            if ($playoff->step()->isFinish()) {
                $championship = $playoff->championship();
                $championship->finished();

                $this->championships->update($championship);
                $this->championships->save();
            }
            $this->entityManager->commit();
        } catch (Exception $exception) {
            $this->entityManager->rollBack();
        }

        $result = new PlayPlayoffMatchesResult($playoff->championship());

        $presenter->addResult($result);
    }
}