<?php

namespace App\Infrastructure\Doctrine\DBAL\Type;

use App\Domain\Entity\Championship\ChampionshipId;
use Doctrine\DBAL\Types\GuidType;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;

final class ChampionshipIdType extends GuidType
{
    public function getName(): string
    {
        return 'championship_id';
    }
}