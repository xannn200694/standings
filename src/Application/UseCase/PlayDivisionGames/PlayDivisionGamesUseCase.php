<?php

namespace App\Application\UseCase\PlayDivisionGames;

use App\Application\Service\GamePlay\DivisionGamePlay;
use App\Application\UseCase;
use App\Application\UseCasePresenter;
use App\Application\UseCaseRequest;
use App\Domain\Entity\Championship\ChampionshipRepository;
use Doctrine\ORM\EntityManagerInterface;

final class PlayDivisionGamesUseCase implements UseCase
{
    private EntityManagerInterface $entityManager;
    private DivisionGamePlay $gamePlay;
    private ChampionshipRepository $championships;

    public function __construct(
        ChampionshipRepository $championships,
        DivisionGamePlay $gamePlay,
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
        $this->gamePlay = $gamePlay;
        $this->championships = $championships;
    }

    public function execute(UseCaseRequest $request, UseCasePresenter $presenter): void
    {
        /**
         * @var PlayDivisionGamesRequest $request
         */
        $championship = $this->championships->findOrFail($request->championshipId());

        try {
            $this->entityManager->beginTransaction();

            foreach ($championship->divisions() as $division) {
                $this->gamePlay->run($division);
            }

            $championship->divisionFinished();
            $this->championships->update($championship);
            $this->championships->save();

            $this->entityManager->commit();
        } catch (\Exception $exception) {
            $this->entityManager->rollBack();
        }

        $result = new PlayDivisionGamesResult($championship);

        $presenter->addResult($result);
    }
}