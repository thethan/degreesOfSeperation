<?php

namespace selftotten\ModelTraits;

use Psr\Http\Message\ResponseInterface;

trait Response {


    protected function getResponsebody(ResponseInterface $response)
    {
        return $response->getBody();
    }

}