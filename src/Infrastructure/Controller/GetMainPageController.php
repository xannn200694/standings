<?php

namespace App\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

final class GetMainPageController
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="main_page", methods={"GET"})
    */
    public function __invoke(): Response
    {
        $content = $this->twig->render('main.html.twig');

        return new Response($content);
    }
}