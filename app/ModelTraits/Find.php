<?php

namespace App\ModelTraits;


trait Find {

    use Send, SetParameters, Request;

    public function find($id = null )
    {
        $this->id = $id;
        $this->_uri = $this->uri() . '/id';
        $this->setParameters('id', $id);
        $this->setRequest();

        $this->send();

        return $this->response->getBody()->getContents();
    }
}