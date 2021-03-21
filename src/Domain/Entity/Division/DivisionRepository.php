<?php

namespace App\Domain\Entity\Division;

interface DivisionRepository
{
    public function add(Division $division): void;
    public function save(): void;
    public function findOrFail(int $id): Division;
}