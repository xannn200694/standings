<?php

namespace App\Application\UseCase\PlayDivisionGames;

use App\Application\Service\GamePlay\DivisionGamePlay;
use App\Application\Transaction;
use App\Application\UseCase;
use App\Application\UseCasePresenter;
use App\Application\UseCaseRequest;
use App\Domain\Entity\Championship\ChampionshipRepository;

final class PlayDivisionGamesUseCase implements UseCase
{
    private DivisionGamePlay $gamePlay;
    private ChampionshipRepository $championships;
    private Transaction $transaction;

    public function __construct(
        ChampionshipRepository $championships,
        DivisionGamePlay $gamePlay,
        Transaction $transaction
    ) {
        $this->gamePlay = $gamePlay;
        $this->championships = $championships;
        $this->transaction = $transaction;
    }

    public function execute(?UseCaseRequest $request, UseCasePresenter $presenter): void
    {
        /**
         * @var PlayDivisionGamesRequest $request
         */
        $championship = $this->championships->findOrFail($request->championshipId());

        try {
            $this->transaction->begin();

            foreach ($championship->divisions() as $division) {
                $this->gamePlay->run($division);
            }

            $championship->divisionFinished();
            $this->championships->update($championship);
            $this->championships->save();

            $this->transaction->commit();
        } catch (\Exception $exception) {
            $this->transaction->rollBack();
        }

        $result = new PlayDivisionGamesResult($championship);

        $presenter->addResult($result);
    }
}