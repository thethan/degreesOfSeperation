<?php

namespace selftotten\Http\Controllers;


use selftotten\Movies;

class ImdbController extends Controller
{
    protected $model;


    public function __constructor()
    {
        $this->model = new IMDb();
    }


    public function getPerson()
    {
        Request::create('http://thethan.com','GET',[],[],[],[],null);
        return $this->model->person_by_id();
    }

    public function test()
    {
        $movies = new Movies();

    }
}