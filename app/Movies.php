<?php

namespace selftotten;

class Movies extends TMDBModel implements SearchInterface, ApiMovieDatabase
{


    public $body;
    public $cast;
    public $cache;
    protected $uri;
    /**
     * @var
     */
    /**
     * @var string
     */
    protected $_uri = 'movie';



    protected function setCast()
    {

//        $this->cast = $this->body->cast;
    }





}
