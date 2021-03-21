<?php

namespace App\Domain\Entity\Division;

interface DivisionGameRepository
{
    public function update(DivisionGame $game): void;
    public function add(DivisionGame $game): void;
    public function save(): void;
    public function find(int $id): DivisionGame;
}