<?php

namespace selftotten\Objects;

class DegreeSelection
{
    public $type, $id, $jpg;

    public function __construct(array $array)
    {
        $vars = get_object_vars($this);

        foreach ($vars as $key => $var) {
            if (array_key_exists( $key, $array)) {
                $this->$key = $array[$key];
            }
        }
    }
}