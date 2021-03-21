<?php

namespace App\Application\UseCase\PlayDivisionGames;

use App\Application\UseCaseRequest;

final class PlayDivisionGamesRequest implements UseCaseRequest
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