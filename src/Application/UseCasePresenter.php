<?php

namespace App\Application;


interface UseCasePresenter
{
    public function addResult(UseCaseResult $result);

    public function present();
}