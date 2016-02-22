<?php

namespace selftotten\ModelTraits;

use GuzzleHttp\Psr7\Request as GuzzleRequest;


trait Request {

    public function url()
    {
        return $this->_uri;
    }

    protected function setRequest()
    {


        $this->request = new GuzzleRequest($this->_method, $this->baseUrl() . $this->uri(). $this->query(), []);

    }

    public function baseUrl()
    {
        return $this->_baseUrl;
    }

    private function query()
    {
        return $this->_query;
    }

}