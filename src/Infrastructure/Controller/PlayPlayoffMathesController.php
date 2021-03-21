<?php

namespace App\Infrastructure\Controller;

use App\Application\UseCase;
use App\Application\UseCase\PlayPlayoffMatches\PlayPlayoffMatchesRequest;
use App\Application\UseCasePresenter;
use Symfony\Component\Routing\Annotation\Route;

final class PlayPlayoffMathesController
{
    private UseCase $useCase;
    private UseCasePresenter $presenter;

    public function __construct(
        UseCase $playPlayoffMatches,
        UseCasePresenter $playPlayoffMatchesPresenter
    ) {
        $this->useCase = $playPlayoffMatches;
        $this->presenter = $playPlayoffMatchesPresenter;
    }

    /**
     * @Route("/playoff/{id}/play", name="playoff.play", methods={"GET"})
    */
    public function __invoke(int $id)
    {
        $request = new PlayPlayoffMatchesRequest($id);

        $this->useCase->execute(
            $request,
            $this->presenter
        );

        return $this->presenter->present();
    }
}