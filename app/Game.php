<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Game extends Model
{
    use DispatchesJobs;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function readable()
    {
    }

    public static function userGames($user_id )
    {
        return self::where('user_id', $user_id)->get();

    }

    public function getItemsForViewing()
    {
        $this->addImages();
        $this->addNames();
    }

    public function addNames()
    {
        $this->addNameProperty('start');
        $this->addNameProperty('end');
    }

    public function addImages()
    {
        $this->addPosterProperty('start');
        $this->addPosterProperty('end');
    }

    protected function addNameProperty($old)
    {
        $property = $old . '_name';
        $actor = new Actors($this->$old);
        $value = $actor->name($this->$old);
        $this->addProperty($property, $value);
    }

    protected function addPosterProperty($old)
    {
        $property = $old . '_image';
        $actor = new Actors($this->$old);
        $value = $actor->poster($this->$old);
        $this->addProperty($property, $value);
    }

    protected function addProperty($property, $value)
    {
        $newProperty = $property;
        $this->$newProperty = $value;
    }


    private function getCacheKey($url)
    {
        return $url;
    }
}
