<?php

namespace App\Application\UseCase\ShowChampionships;


use App\Application\UseCaseResult;

final class ShowChampionshipsResult implements UseCaseResult
{
    private array $championships;

    public function __construct(array $championships)
    {
        $this->championships = $championships;
    }

    public function toArray(): array
    {
        return [
            'championships' => $this->championships,
        ];
    }
}