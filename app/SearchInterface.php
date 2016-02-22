<?php

namespace selftotten;

interface SearchInterface
{
    /**
     * @param $text
     * @return mixed
     */
    public function search($text);
}