<?php

namespace App\Infrastructure\Controller;

use App\Application\UseCase;
use App\Application\UseCase\ShowChampionship\ShowChampionshipRequest;
use App\Application\UseCasePresenter;
use Symfony\Component\Routing\Annotation\Route;

final class ShowChampionshipController
{
    private UseCase $useCase;
    private UseCasePresenter $presenter;

    public function __construct(
        UseCase $showChampionship,
        UseCasePresenter $showChampionshipPresenter
    ) {
        $this->useCase = $showChampionship;
        $this->presenter = $showChampionshipPresenter;
    }

    /**
     * @Route("/championships/{id}", name="championship.show", methods={"GET"})
    */
    public function __invoke(int $id)
    {
        $request = new ShowChampionshipRequest($id);

        $this->useCase->execute(
            $request,
            $this->presenter
        );

        return $this->presenter->present();
    }
}