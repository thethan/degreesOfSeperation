<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Cache;

class Movies extends TMDBModel implements SearchInterface, ApiMovieDatabase
{


    public $body;

    protected $uri;

    public $cast;

    public $cache;
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
