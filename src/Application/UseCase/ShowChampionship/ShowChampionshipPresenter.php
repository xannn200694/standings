<?php

namespace App\Application\UseCase\ShowChampionship;


use App\Application\UseCasePresenter;
use App\Application\UseCaseResult;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class ShowChampionshipPresenter implements UseCasePresenter
{
    private UseCaseResult $result;
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function addResult(UseCaseResult $result)
    {
        $this->result = $result;
    }

    public function present()
    {
        $content = $this->twig->render('championships/show.html.twig', $this->result->toArray());

        return new Response($content);
    }
}