<?php

namespace App\Application\UseCase\CreateDivision;


use App\Application\UseCase;
use App\Application\UseCasePresenter;
use App\Application\UseCaseRequest;
use App\Domain\Entity\Championship\ChampionshipRepository;
use App\Domain\Service\Factory\Division\DivisionFactory;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

final class CreateDivisionUseCase implements UseCase
{
    private const COUNT_TEAM_IN_DIVISION = 8;

    private ChampionshipRepository $championships;
    private DivisionFactory $divisionFactory;
    private EntityManagerInterface $entityManager;

    public function __construct(
        ChampionshipRepository $championships,
        DivisionFactory $divisionFactory,
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
        $this->championships = $championships;
        $this->divisionFactory = $divisionFactory;
    }

    public function execute(UseCaseRequest $request, UseCasePresenter $presenter): void
    {
        /** @var CreateDivisionRequest $request */
        $championship = $this->championships->findOrFail($request->championshipId());

        $this->entityManager->beginTransaction();

        try {
            $this->divisionFactory->create($championship, 'A');
            $this->divisionFactory->create($championship, 'B');

            $championship->divisionCreated();
            $this->championships->update($championship);
            $this->championships->save();

            $this->entityManager->commit();
        } catch (Exception $exception) {
            $this->entityManager->rollback();
        }

        $presenter->addResult(
            new CreateDivisionResult($championship)
        );
    }
}