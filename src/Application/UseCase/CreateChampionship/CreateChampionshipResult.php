<?php

namespace App\Application\UseCase\CreateChampionship;

use App\Application\UseCaseResult;
use App\Domain\Entity\Championship\Championship;

final class CreateChampionshipResult implements UseCaseResult
{
    private Championship $championship;

    public function __construct(Championship $championship)
    {
        $this->championship = $championship;
    }

    public function toArray(): array
    {
        return [];
    }

    public function championship(): Championship
    {
        return $this->championship;
    }
}