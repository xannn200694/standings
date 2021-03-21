<?php


namespace App\Domain\Entity\Playoff;


use MyCLabs\Enum\Enum;

/**
 * @method static PlayoffMatchStep ONE_THIRD_FINAL()
 * @method static PlayoffMatchStep SEMI_FINAL()
 * @method static PlayoffMatchStep FINAL()
*/
final class PlayoffMatchStep extends Enum
{
    private const ONE_THIRD_FINAL = 'one_third_final';
    private const SEMI_FINAL = 'semi_final';
    private const FINAL = 'final';

    public function isOneThirdFinal(): bool
    {
        return $this->equals(self::ONE_THIRD_FINAL());
    }

    public function isSemiFinal(): bool
    {
        return $this->equals(self::SEMI_FINAL());
    }

    public function isFinal(): bool
    {
        return $this->equals(self::FINAL());
    }
}