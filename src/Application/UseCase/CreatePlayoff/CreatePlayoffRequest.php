<?php

namespace App\Application\UseCase\CreatePlayoff;

use App\Application\UseCaseRequest;

final class CreatePlayoffRequest implements UseCaseRequest
{
    private int $championshipId;

    public function __construct(int $championshipId)
    {
        $this->championshipId = $championshipId;
    }

    public function championshipId(): int
    {
        return $this->championshipId;
    }
}