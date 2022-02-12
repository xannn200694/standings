<?php

namespace App\Application\UseCase\CreateDivision;

use App\Application\UseCaseResult;
use App\Domain\Entity\Championship\Championship;

final class CreateDivisionResult implements UseCaseResult
{
    private Championship $championship;

    public function __construct(Championship $championship)
    {
        $this->championship = $championship;
    }

    public function championship(): Championship
    {
        return $this->championship;
    }
}