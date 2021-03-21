<?php

namespace App\Application\Service\DivisionPresenter;


use App\Domain\Entity\Division\Score;
use Exception;

final class DivisionPresenter
{
    private array $items = [];
    public array $total = [];

    public function add(int $firstTeam, int $secondTeam, Score $score): void
    {
        $key = $this->key($firstTeam, $secondTeam);

        if (array_key_exists($key, $this->items)) {
            return;
        }

        if (array_key_exists($firstTeam, $this->total)) {
            $this->total[$firstTeam] += $score->firstTeam();
        } else {
            $this->total[$firstTeam] = $score->firstTeam();
        }

        $this->items[$key] = $score->toString();
    }

    public function total(int $teamId): int
    {
        if (! isset($this->total[$teamId])) {
            throw new Exception('Not exist total result for team: ' . $teamId);
        }

        return $this->total[$teamId];
    }

    public function get(int $firstTeam, int $secondTeam): string
    {
        $key = $this->key($firstTeam, $secondTeam);
        $revertedKey = $this->key($secondTeam, $firstTeam);

        if (isset($this->items[$key])) {
            return $this->items[$key];
        }

        if (isset($this->items[$revertedKey])) {
            return $this->items[$revertedKey];
        }

        throw new Exception('Pairs not Found:' . $key);
    }

    private function key(int $firstPart, int $secondPart): string
    {
        return $firstPart . '-' . $secondPart;
    }
}