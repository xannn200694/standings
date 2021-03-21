<?php

namespace App\Infrastructure\Controller;

use App\Application\UseCase;
use App\Application\UseCasePresenter;
use App\Application\UseCaseRequest;
use Symfony\Component\Routing\Annotation\Route;

final class CreateChampionshipController
{
    private UseCase $useCase;
    private UseCaseRequest $request;
    private UseCasePresenter $presenter;

    public function __construct(
        UseCase $createChampionship,
        UseCaseRequest $createChampionshipRequest,
        UseCasePresenter $createChampionshipPresenter
    ) {
        $this->useCase = $createChampionship;
        $this->request = $createChampionshipRequest;
        $this->presenter = $createChampionshipPresenter;
    }

    /**
     * @Route("/championships/create", name="championships.create", methods={"GET"})
     */
    public function __invoke()
    {
        $this->useCase->execute(
            $this->request,
            $this->presenter
        );

        return $this->presenter->present();
    }
}