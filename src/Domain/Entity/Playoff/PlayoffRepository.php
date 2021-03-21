<?php


namespace App\Domain\Entity\Playoff;


interface PlayoffRepository
{
    public function add(Playoff $playoff): void;
    public function update(Playoff $playoff): void;
    public function save(): void;
    public function findOrFail(int $id): Playoff;
}