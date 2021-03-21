<?php

namespace App\Infrastructure\Doctrine\ORM\Repository;

use App\Domain\Entity\Championship\Championship;
use App\Domain\Entity\Division\Division;
use App\Domain\Entity\Division\DivisionRepository;
use Doctrine\ORM\EntityManagerInterface;
use RuntimeException;

final class OrmDivisionRepository implements DivisionRepository
{
    private EntityManagerInterface $entityManager;
    private string $className = Division::class;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Division $division): void
    {
        $this->entityManager->persist($division);
    }

    public function save(): void
    {
        $this->entityManager->flush();
    }

    public function findOrFail(int $id): Division
    {
        $entity = $this->entityManager->find($this->className, $id);
        if (NULL === $entity) {
            throw new RuntimeException('Division not found');
        }

        return $entity;
    }
}