<?php

namespace App\Infrastructure\Controller;


use App\Application\UseCase;
use App\Application\UseCasePresenter;
use App\Application\UseCaseRequest;
use Symfony\Component\Routing\Annotation\Route;

final class CreateDivisionController
{
    private UseCase $useCase;
    private UseCaseRequest $request;
    private UseCasePresenter $presenter;

    public function __construct(
        UseCase $createDivision,
        UseCaseRequest $createDivisionRequest,
        UseCasePresenter $createDivisionPresenter
    ) {
        $this->useCase = $createDivision;
        $this->request = $createDivisionRequest;
        $this->presenter = $createDivisionPresenter;
    }

    /**
     * @Route("/divisions/create", name="divisions.create", methods={"POST"})
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