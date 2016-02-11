<?php

namespace App;

use App\Jobs\CacheFind;
use App\ModelTraits\Find;
use App\ModelTraits\Send;
use App\Objects\Cast;
use App\ModelTraits\Search;
use GuzzleHttp\Client;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Cache;

class TMDBModel implements ApiMovieDatabase
{

    use DispatchesJobs;

    /**
     *
     */
    use Find, Search;

    /**
     * @var
     */
    public $id;
    /**
     * @var Client
     */
    public $client;

    /**
     * @var
     */
    public $request;

    /**
     * @var
     */
    public $response;
    /**
     * @var
     */
    public $body;

    public $credits;

    /**
     * @var string
     */
    protected $_baseUrl = 'https://api.themoviedb.org/3/';

    /**
     * @var string
     */
    protected $_uri = 'movie';

    /**
     * @var string
     */
    protected $_query = '?';

    /**
     * @var string
     */
    protected $_method = 'GET';

    /**
     * @var string
     */
    private $api_key = '0efd46e620a107df3362f01a25c1ff7b';

    /**
     * @var
     */
    protected $cache;

    /**
     * TMDBModel constructor.
     */
    public function __construct($id = null)
    {
        $this->client = new Client();

        $this->setApiKey();
        if($id){
            $this->id = $id;
        }
    }

    /**
     * Returns the uri of the call.
     * @return string
     */
    public function uri()
    {
        return $this->_uri;
    }

    public function setCredits($id = null)
    {
        $this->id = $id;

        $uri = $this->_uri . "/credits";
        $this->_uri =  $uri;
        $this->setRequest();

        $this->send();

        $this->credits =  $this->returnObject(Cast::class);

        return $this->credits;

    }


    /**
     * Set the API Key to the Query String
     */
    private function setApiKey()
    {
        $this->setQuery('api_key', $this->api_key);
    }

    public function poster($id = null)
    {

        $value = $this->dispatch(new CacheFind($this, $this->id));
        $object = json_decode($value);
        return $object->poster_path;
    }

    public function name()
    {
        $value = $this->dispatch(new CacheFind($this, $this->id));
        $object = json_decode($value);
        return $object->name;
    }

    public function setUri($value)
    {
        $this->_uri = $value;
    }

}
