<?php

namespace App\ModelTraits;

use Psr\Http\Message\ResponseInterface;

trait Response {


    protected function getResponsebody(ResponseInterface $response)
    {
        return $response->getBody();
    }

}