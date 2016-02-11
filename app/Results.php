<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    //

    public static $dos = ['id' => 0, 'title' => '', 'poster_path' => '', 'type' => ''];

    public function game()
    {
        return $this->belongsTo('App/Game');
    }

    public function gameStart(Game $game)
    {
        $result = [];
        $dos = self::dosObject($game->start, $game->start_name, $game->start_poster, $game->start_type);
        $result[] = $dos;

        $this->results = json_encode($result);

    }

    public static function dosObject($id = null, $title = null, $poster_path = null, $type = 'person')
    {
        $dos = self::$dos;
        $dos = ['id' => $id, 'title' => $title, 'poster_path' => $poster_path, 'type' => $type];

        return $dos;
    }

    public function saveDos($dos)
    {
        $this->steps = count($dos);
        $this->results = json_encode($dos);
        $this->save();
    }
}
