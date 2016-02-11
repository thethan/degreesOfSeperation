<?php

namespace App;

interface SearchInterface
{
    /**
     * @param $text
     * @return mixed
     */
    public function search($text);
}