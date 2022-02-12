<?php

namespace App\Application\UseCase\CreatePlayoff;

use App\Application\Transaction;
use App\Domain\Service\Factory\Playoff\PlayoffFactory;
use App\Application\UseCase;
use App\Application\UseCasePresenter;
use App\Application\UseCaseRequest;
use App\Domain\Entity\Championship\ChampionshipRepository;
use Exception;

final class CreatePlayoffUseCase implements UseCase
{
    private ChampionshipRepository $championships;
    private PlayoffFactory $playoffFactory;
    private Transaction $transaction;

    public function __construct(
        ChampionshipRepository $championships,
        PlayoffFactory $playoffFactory,
        Transaction $transaction
    ) {
        $this->championships = $championships;
        $this->playoffFactory = $playoffFactory;
        $this->transaction = $transaction;
    }

    public function execute(?UseCaseRequest $request, UseCasePresenter $presenter): void
    {
        /**
         * @var CreatePlayoffRequest $request
         */
        $championship = $this->championships->findOrFail($request->championshipId());

        $this->transaction->begin();

        try {
            $this->playoffFactory->create($championship);

            $championship->playoffCreated();

            $this->championships->update($championship);
            $this->championships->save();

            $this->transaction->commit();
        } catch (Exception $exception) {
            $this->transaction->rollback();
        }

        $result = new CreatePlayoffResult($championship);

        $presenter->addResult($result);
    }
}