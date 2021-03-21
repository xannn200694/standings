<?php

namespace App\Infrastructure\Doctrine\ORM\Repository;

use App\Domain\Entity\Championship\Championship;
use App\Domain\Entity\Championship\ChampionshipRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use RuntimeException;

final class OrmChampionshipRepository implements ChampionshipRepository
{
    private EntityManagerInterface $entityManager;
    private string $className = Championship::class;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function update(Championship $championship): void
    {
        $this->entityManager->persist($championship);
    }

    public function add(Championship $championship): void
    {
        $this->entityManager->persist($championship);
    }

    public function save():void
    {
        $this->entityManager->flush();
    }

    public function findOrFail(int $id): Championship
    {
        $entity = $this->entityManager->find($this->className, $id);
        if (NULL === $entity) {
            throw new RuntimeException('Championship %s not found');
        }

        return $entity;
    }

    /**
     * @return Championship[]
    */
    public function all(): array
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('c')
            ->from($this->className, 'c')
            ->getQuery()
            ->execute();
    }
}