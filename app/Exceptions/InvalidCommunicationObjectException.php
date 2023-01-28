<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;

class InvalidCommunicationObjectException extends Exception
{
    private mixed $object;
    private Model $model;

    public function __construct(mixed $object, Model $model)
    {
        parent::__construct();
        $this->object = $object;
        $this->model = $model;
    }

    protected $message = 'Object does not implement GeneratesCommunicationContract';


    public function report(): mixed
    {
        $communicationObjectDescription = is_object($this->object) ? get_class($this->object) : var_export($this->object);
        return $communicationObjectDescription.' must implement GeneratesCommunicationContract. Customer Id:'.$this->model->id;
    }
}
