<?php

namespace App\Domain\Entity\Championship;


use MyCLabs\Enum\Enum;

/**
 * @method static ChampionshipStatus NEW();
 * @method static ChampionshipStatus DIVISION_CREATED();
 * @method static ChampionshipStatus DIVISION_FINISHED();
 * @method static ChampionshipStatus PLAYOFF_CREATED();
 * @method static ChampionshipStatus FINISHED();
*/
final class ChampionshipStatus extends Enum
{
    private const NEW = 'new';
    private const DIVISION_CREATED = 'division_created';
    private const DIVISION_FINISHED = 'division_finished';
    private const PLAYOFF_CREATED = 'playoff_created';
    private const FINISHED = 'finished';

    public function isNew(): bool
    {
        return $this->equals(self::NEW());
    }

    public function isDivisionCreated(): bool
    {
        return $this->equals(self::DIVISION_CREATED());
    }

    public function isDivisionFinished(): bool
    {
        return $this->equals(self::DIVISION_FINISHED());
    }

    public function isPlayoffCreated(): bool
    {
        return $this->equals(self::PLAYOFF_CREATED());
    }

    public function isFinished(): bool
    {
        return $this->equals(self::FINISHED());
    }
}