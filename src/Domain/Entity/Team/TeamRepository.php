<?php

namespace App\Domain\Entity\Team;

interface TeamRepository
{
    public function add(Team $team): void;
    public function save(): void;
}