<?php


namespace App\Infrastructure\Doctrine\ORM\Repository;


use App\Domain\Entity\Playoff\Playoff;
use App\Domain\Entity\Playoff\PlayoffRepository;
use Doctrine\ORM\EntityManagerInterface;

final class OrmPlayoffRepository implements PlayoffRepository
{
    private EntityManagerInterface $entityManager;
    private string $className = Playoff::class;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Playoff $playoff): void
    {
        $this->entityManager->persist($playoff);
    }

    public function update(Playoff $playoff): void
    {
        $this->entityManager->persist($playoff);
    }

    public function save(): void
    {
        $this->entityManager->flush();
    }

    public function findOrFail(int $id): Playoff
    {
        /**
         * @var Playoff $playoff
        */
        $playoff = $this->entityManager->find($this->className, $id);

        if (NULL === $playoff) {
            throw new \Exception('not found');
        }

        return $playoff;
    }
}