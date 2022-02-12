<?php

namespace App\Application\UseCase\CreatePlayoff;


use App\Application\UseCaseResult;
use App\Domain\Entity\Championship\Championship;

final class CreatePlayoffResult implements UseCaseResult
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