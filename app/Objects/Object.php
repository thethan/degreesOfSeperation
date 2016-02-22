<?php

namespace selftotten\Objects;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class Object implements ObjectInterface
{
    /**
     * Object constructor.
     * @param ResponseInterface $response
     */
    public function __construct(Response $response)
    {
        $obj = json_decode($response->getBody()->getContents());

        $vars = get_object_vars($this);

        foreach ($vars as $key => $var) {
            if (property_exists($obj, $key)) {
                $this->$key = $obj->$key;
            }
        }

    }
}