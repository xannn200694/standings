<?php

namespace App\Application\UseCase\PlayPlayoffMatches;

use App\Application\Service\GamePlay\PlayoffGamePlay;
use App\Application\Transaction;
use App\Application\UseCase;
use App\Application\UseCasePresenter;
use App\Application\UseCaseRequest;
use App\Domain\Entity\Championship\ChampionshipRepository;
use App\Domain\Entity\Playoff\PlayoffRepository;
use Exception;

final class PlayPlayoffMatchesUseCase implements UseCase
{
    private PlayoffRepository $playoffs;
    private PlayoffGamePlay $gamePlay;
    private ChampionshipRepository $championships;
    private Transaction $transaction;

    public function __construct(
        PlayoffRepository $playoffs,
        PlayoffGamePlay $gamePlay,
        ChampionshipRepository $championships,
        Transaction $transaction
    ) {
        $this->playoffs = $playoffs;
        $this->gamePlay = $gamePlay;
        $this->championships = $championships;
        $this->transaction = $transaction;
    }

    public function execute(?UseCaseRequest $request, UseCasePresenter $presenter): void
    {
        /**
         * @var PlayPlayoffMatchesRequest $request
         */
        $playoff = $this->playoffs->findOrFail($request->id());

        try {
            $this->transaction->begin();

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
            $this->transaction->commit();
        } catch (Exception $exception) {
            $this->transaction->rollBack();
        }

        $result = new PlayPlayoffMatchesResult($playoff->championship());

        $presenter->addResult($result);
    }
}