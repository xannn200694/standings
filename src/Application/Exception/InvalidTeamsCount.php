<?php

namespace App\Application\Exception;

use LogicException;

final class InvalidTeamsCount extends LogicException
{
    protected $message = 'Quantity teams must be even.';
}