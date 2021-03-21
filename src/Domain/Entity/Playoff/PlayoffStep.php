<?php


namespace App\Domain\Entity\Playoff;


use MyCLabs\Enum\Enum;

/**
 * @method static PlayoffStep ONE_THIRD_FINAL()
 * @method static PlayoffStep SEMI_FINAL()
 * @method static PlayoffStep FINAL()
 * @method static PlayoffStep FINISH()
*/
final class PlayoffStep extends Enum
{
    private const ONE_THIRD_FINAL = 'one_third_final';
    private const SEMI_FINAL = 'semi_final';
    private const FINAL = 'final';
    private const FINISH = 'finish';

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

    public function isFinish(): bool
    {
        return $this->equals(self::FINISH());
    }

    public function next()
    {
//        while(current($this) !== 5) {
//            next($array);
//        }
//
//        var_dump(next($array));
    }
}