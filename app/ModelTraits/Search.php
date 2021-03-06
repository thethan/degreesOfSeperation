<?php

namespace selftotten\ModelTraits;

use selftotten\Objects\Search as SearchObject;

trait Search {


    public function search($text)
    {
        $uri = 'search/'.$this->_uri;
        $this->_uri =  $uri;
        $this->setQuery('query', $text);
        $this->setRequest();

        $this->send();

        return $this->returnObject(SearchObject::class);

    }


}