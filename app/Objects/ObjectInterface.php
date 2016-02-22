<?php

namespace selftotten\Objects;


use GuzzleHttp\Psr7\Response;

interface ObjectInterface
{
    public function __construct(Response $response);
}