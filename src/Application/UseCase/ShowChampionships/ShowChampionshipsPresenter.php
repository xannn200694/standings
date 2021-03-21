<?php

namespace App\Application\UseCase\ShowChampionships;


use App\Application\UseCasePresenter;
use App\Application\UseCaseResult;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class ShowChampionshipsPresenter implements UseCasePresenter
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

    public function present(): Response
    {
        $content = $this->twig->render('championships/list.html.twig', $this->result->toArray());

        return new Response($content);
    }
}