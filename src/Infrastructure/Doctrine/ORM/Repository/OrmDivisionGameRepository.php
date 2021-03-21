<?php

namespace App\Infrastructure\Doctrine\ORM\Repository;

use App\Domain\Entity\Division\Division;
use App\Domain\Entity\Division\DivisionGame;
use App\Domain\Entity\Division\DivisionGameRepository;
use App\Domain\Entity\Division\DivisionRepository;
use Doctrine\ORM\EntityManagerInterface;
use RuntimeException;

final class OrmDivisionGameRepository implements DivisionGameRepository
{
    private EntityManagerInterface $entityManager;
    private string $className = DivisionGame::class;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function update(DivisionGame $game): void
    {
        $this->entityManager->persist($game);
    }

    public function add(DivisionGame $game): void
    {
        $this->entityManager->persist($game);
    }

    public function save():void
    {
        $this->entityManager->flush();
    }

    public function find(int $id): DivisionGame
    {
        $entity = $this->entityManager->find($this->className, $id);
        if (NULL === $entity) {
            throw new RuntimeException('Game not found');
        }

        return $entity;
    }
}