<?php

namespace App\Application\UseCase\CreateDivision;


use App\Application\UseCaseRequest;
use App\Domain\Entity\Championship\ChampionshipRepository;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;

final class CreateDivisionRequest implements UseCaseRequest
{
    private int $championshipId;

    public function __construct()
    {
        $request = Request::createFromGlobals();
        $this->championshipId = $request->get('championship');

        if (NULL === $this->championshipId) {
            throw new InvalidArgumentException('championship is missed');
        }
    }

    public function championshipId(): int
    {
        return $this->championshipId;
    }
}