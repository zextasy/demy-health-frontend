<?php

namespace App\Exceptions;

use Exception;

class NoMergeDataException extends Exception
{
    protected $message =
        'Template merge data is required when a communicationObject is of type CommunicationTemplate or Campaign.';
}
