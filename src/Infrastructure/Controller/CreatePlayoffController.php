<?php

namespace App\Infrastructure\Controller;


use App\Application\UseCase;
use App\Application\UseCase\CreatePlayoff\CreatePlayoffRequest;
use App\Application\UseCasePresenter;
use App\Application\UseCaseRequest;
use Symfony\Component\Routing\Annotation\Route;

final class CreatePlayoffController
{
    private UseCase $useCase;
    private UseCasePresenter $presenter;

    public function __construct(
        UseCase $createPlayoff,
        UseCasePresenter $createPlayoffPresenter
    ) {
        $this->useCase = $createPlayoff;
        $this->presenter = $createPlayoffPresenter;
    }

    /**
     * @Route("/championships/{id}/playoff/create", name="playoff.create", methods={"GET"})
     */
    public function __invoke(int $id)
    {
        $request = new CreatePlayoffRequest($id);

        $this->useCase->execute(
            $request,
            $this->presenter
        );

        return $this->presenter->present();
    }
}