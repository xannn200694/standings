<?php

namespace App\Infrastructure\Controller;

use App\Application\UseCase;
use App\Application\UseCasePresenter;
use App\Application\UseCaseRequest;
use Symfony\Component\Routing\Annotation\Route;

final class CreateChampionshipController
{
    private UseCase $useCase;
    private UseCasePresenter $presenter;

    public function __construct(
        UseCase $createChampionship,
        UseCasePresenter $createChampionshipPresenter
    ) {
        $this->useCase = $createChampionship;
        $this->presenter = $createChampionshipPresenter;
    }

    /**
     * @Route("/championships/create", name="championships.create", methods={"GET"})
     */
    public function __invoke()
    {
        $this->useCase->execute(
            null,
            $this->presenter
        );

        return $this->presenter->present();
    }
}