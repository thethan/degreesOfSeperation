<?php

namespace App;

use GuzzleHttp\Client;


interface ApiMovieDatabase
{


    /**
     * @param $id
     * @return mixed
     */

    public function find($id);



}
