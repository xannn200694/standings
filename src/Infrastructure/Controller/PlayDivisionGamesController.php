<?php

namespace App\Infrastructure\Controller;

use App\Application\UseCase;
use App\Application\UseCase\PlayDivisionGames\PlayDivisionGamesRequest;
use App\Application\UseCasePresenter;
use Symfony\Component\Routing\Annotation\Route;

final class PlayDivisionGamesController
{
    private UseCase $useCase;
    private UseCasePresenter $presenter;

    public function __construct(
        UseCase $playDivisionGames,
        UseCasePresenter $playDivisionGamesPresenter
    ) {
        $this->useCase = $playDivisionGames;
        $this->presenter = $playDivisionGamesPresenter;
    }

    /**
     * @Route("/divisions/{championshipId}/games/play", name="divisions.games.play", methods={"GET"})
    */
    public function __invoke(int $championshipId)
    {
        $request = new PlayDivisionGamesRequest($championshipId);

        $this->useCase->execute(
            $request,
            $this->presenter
        );

        return $this->presenter->present();
    }
}