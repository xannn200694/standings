<?php


namespace App\Application\Service;


use App\Domain\Entity\Playoff\PlayoffMatchStep;
use App\Domain\Entity\Playoff\PlayoffStep;
use InvalidArgumentException;

final class PlayoffMapper
{
    private array $playoffToMatch;

    public function __construct()
    {
        $this->playoffToMatch = [
            PlayoffStep::ONE_THIRD_FINAL()->getValue() => PlayoffMatchStep::ONE_THIRD_FINAL(),
            PlayoffStep::SEMI_FINAL()->getValue() => PlayoffMatchStep::SEMI_FINAL(),
            PlayoffStep::FINAL()->getValue() => PlayoffMatchStep::FINAL(),
        ];
    }

    public function get(PlayoffStep $playoffStep): PlayoffMatchStep
    {
        if (! array_key_exists($playoffStep->getValue(), $this->playoffToMatch)) {
            throw new InvalidArgumentException('Status not exist');
        }

        return $this->playoffToMatch[$playoffStep->getValue()];
    }
}