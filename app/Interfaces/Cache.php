<?php

namespace App\Interfaces;


interface Cache
{
    /**
     * @param $type
     * @return mixed
     */
    public function getCache($type);

    /**
     * @param $type
     * @param $id
     * @return mixed
     */
    public function setCache($type, $id);

    /**
     * @param $type
     * @param $id
     * @return mixed
     */
    public function checkExistence($type, $id);

}