<?php

namespace App\ModelTraits;

use GuzzleHttp\Psr7\Request as GuzzleRequest;


trait Request {

    public function baseUrl()
    {
        return $this->_baseUrl;
    }

    public function url()
    {
        return $this->_uri;
    }

    private function query()
    {
        return $this->_query;
    }


    protected function setRequest()
    {


        $this->request = new GuzzleRequest($this->_method, $this->baseUrl() . $this->uri(). $this->query(), []);

    }

}