<?php

namespace App\Application\UseCase\PlayPlayoffMatches;


use App\Application\UseCaseRequest;

final class PlayPlayoffMatchesRequest implements UseCaseRequest
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