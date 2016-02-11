<?php

namespace App;

use App\Jobs\CacheFind;
use App\Objects\Cast;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Cache;

class Actors extends TMDBModel implements SearchInterface, ApiMovieDatabase
{


    public $body;

    public $uri;

    /**
     * @var
     */

    /**
     * @var string
     */
    protected $_uri = 'person';

    public function poster($id = null)
    {

        $value = $this->dispatch(new CacheFind($this, $this->id));
        $object = json_decode($value);
        return $object->profile_path;
    }


}
