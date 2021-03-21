<?php


namespace App\Domain\Service\Factory;


use App\Application\Exception\InvalidTeamsCount;
use App\Domain\Entity\Division\Division;
use App\Domain\Entity\Team\Team;
use App\Domain\Entity\Team\TeamRepository;

final class TeamsFactory
{
    private const COUNT_TEAM_IN_DIVISION = 8;
    private TeamRepository $teams;


    public function __construct(TeamRepository $teams)
    {
        $this->teams = $teams;
    }

    /**
     * @return Team[]
    */
    public function create(Division $division): array
    {
        if ($this->isNotEven(self::COUNT_TEAM_IN_DIVISION)) {
            throw new InvalidTeamsCount('The number of teams must be an even number.');
        }

        $teams = [];
        for ($i = 0; $i < self::COUNT_TEAM_IN_DIVISION; $i++) {
            $team = new Team($division,$this->generateTeamName($i));
            $this->teams->add($team);
            $division->teams()->add($team);

            $teams[] = $team;
        }

        return $teams;
    }

    private function isNotEven(int $number): bool
    {
        return $number % 2;
    }

    private function generateTeamName(int $number): string
    {
        return sprintf('Team %s', ++$number);
    }
}