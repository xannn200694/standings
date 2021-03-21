<?php

namespace App\Infrastructure\Doctrine\ORM\Repository;

use App\Domain\Entity\Team\Team;
use App\Domain\Entity\Team\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;

final class OrmTeamRepository implements TeamRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Team $team): void
    {
        $this->entityManager->persist($team);
    }

    public function save():void
    {
        $this->entityManager->flush();
    }
}