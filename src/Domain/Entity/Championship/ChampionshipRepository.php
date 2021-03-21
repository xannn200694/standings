<?php

namespace App\Domain\Entity\Championship;


interface ChampionshipRepository
{
    public function update(Championship $championship): void;
    public function add(Championship $championship): void;
    public function save(): void;
    public function findOrFail(int $id): Championship;
    public function all(): array;
}