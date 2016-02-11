<?php


namespace App\ModelTraits;

use App\Objects\Object;
use App\Objects\ObjectInterface;


trait ResponseObjects
{
    protected function returnObject($object)
    {
        return new $object($this->response);
    }
}