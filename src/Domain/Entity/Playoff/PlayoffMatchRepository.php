<?php

namespace App\Domain\Entity\Playoff;

interface PlayoffMatchRepository
{
    public function add(PlayoffMatch $match): void;
    public function update(PlayoffMatch $match): void;
    public function save(): void;
}