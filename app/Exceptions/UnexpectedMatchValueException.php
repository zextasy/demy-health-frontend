<?php

namespace App\Exceptions;

use Exception;

class UnexpectedMatchValueException extends Exception
{
    protected $message = 'Unexpected match value';
}
