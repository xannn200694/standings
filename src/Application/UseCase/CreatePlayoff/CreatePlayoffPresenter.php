<?php

namespace App\Application\UseCase\CreatePlayoff;


use App\Application\UseCasePresenter;
use App\Application\UseCaseResult;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class CreatePlayoffPresenter implements UseCasePresenter
{
    private UseCaseResult $result;
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function addResult(UseCaseResult $result)
    {
        $this->result = $result;
    }

    public function present()
    {
        /**
         * @var CreatePlayoffResult $result
         */
        $result = $this->result;
        $url = $this->urlGenerator->generate('championship.show', [
            'id' => $result->championship()->id()
        ]);

        return new RedirectResponse($url);
    }
}