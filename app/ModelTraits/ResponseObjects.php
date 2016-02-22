<?php


namespace selftotten\ModelTraits;


trait ResponseObjects
{
    protected function returnObject($object)
    {
        return new $object($this->response);
    }
}