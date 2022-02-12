<?php

namespace App\Infrastructure\Controller;

use App\Application\UseCase;
use App\Application\UseCasePresenter;
use Symfony\Component\Routing\Annotation\Route;

final class ShowChampionshipsController
{
    private UseCase $useCase;
    private UseCasePresenter $presenter;

    public function __construct(
        UseCase $showChampionships,
        UseCasePresenter $showChampionshipsPresenter
    ) {
        $this->useCase = $showChampionships;
        $this->presenter = $showChampionshipsPresenter;
    }

    /**
     * @Route("/championships", name="championships", methods={"GET"})
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