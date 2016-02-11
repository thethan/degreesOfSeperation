<?php

namespace App\Objects;


use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

interface ObjectInterface
{
    public function __construct(Response $response);
}