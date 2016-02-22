<?php

namespace selftotten\ModelTraits;

trait Send {

    use ResponseObjects;

    protected function send()
    {
        $this->response = $this->client->send($this->request);

    }

    protected function setBody()
    {
        $this->body = $this->response->getBody()->getContents();
    }


}