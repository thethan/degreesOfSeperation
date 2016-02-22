<?php

namespace selftotten;

use selftotten\Jobs\CacheFind;

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
