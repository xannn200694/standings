<?php

namespace App\Application\UseCase\ShowChampionship;

use App\Application\UseCaseRequest;

final class ShowChampionshipRequest implements UseCaseRequest
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }
}