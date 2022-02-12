<?php

namespace App\Application;

interface UseCase
{
    public function execute(?UseCaseRequest $request, UseCasePresenter $presenter): void;
}