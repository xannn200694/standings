<?php

namespace App\Application\UseCase\CreatePlayoff;

use App\Domain\Service\Factory\Playoff\PlayoffFactory;
use App\Application\UseCase;
use App\Application\UseCasePresenter;
use App\Application\UseCaseRequest;
use App\Domain\Entity\Championship\ChampionshipRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

final class CreatePlayoffUseCase implements UseCase
{
    private ChampionshipRepository $championships;
    private PlayoffFactory $playoffFactory;
    private EntityManagerInterface $entityManager;

    public function __construct(
        ChampionshipRepository $championships,
        EntityManagerInterface $entityManager,
        PlayoffFactory $playoffFactory
    ) {
        $this->championships = $championships;
        $this->playoffFactory = $playoffFactory;
        $this->entityManager = $entityManager;
    }

    public function execute(UseCaseRequest $request, UseCasePresenter $presenter): void
    {
        /**
         * @var CreatePlayoffRequest $request
         */
        $championship = $this->championships->findOrFail($request->championshipId());

        $this->entityManager->beginTransaction();

        try {
            $this->playoffFactory->create($championship);

            $championship->playoffCreated();

            $this->championships->update($championship);
            $this->championships->save();

            $this->entityManager->commit();
        } catch (Exception $exception) {
            $this->entityManager->rollback();
        }

        $result = new CreatePlayoffResult($championship);

        $presenter->addResult($result);
    }
}