<?php

namespace App\ModelTraits;


trait SetParameters {


    public function setParameters($name, $id)
    {
        $this->_uri = str_replace($name, $id, $this->_uri);
    }

    protected function setQuery($name, $value)
    {
        if(strlen($this->_query) > 1){
            $operator = '&';
        } else {
            $operator = '';
        }

        $this->_query .= $operator .$name.'='.urlencode($value);
    }

}