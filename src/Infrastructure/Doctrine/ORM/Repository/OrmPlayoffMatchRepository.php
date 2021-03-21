<?php


namespace App\Infrastructure\Doctrine\ORM\Repository;


use App\Domain\Entity\Playoff\Playoff;
use App\Domain\Entity\Playoff\PlayoffMatch;
use App\Domain\Entity\Playoff\PlayoffMatchRepository;
use Doctrine\ORM\EntityManagerInterface;

final class OrmPlayoffMatchRepository implements PlayoffMatchRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(PlayoffMatch $match): void
    {
        $this->entityManager->persist($match);
    }

    public function update(PlayoffMatch $match): void
    {
        $this->entityManager->persist($match);
    }

    public function save(): void
    {
        $this->entityManager->flush();
    }
}