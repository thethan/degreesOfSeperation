<?php

namespace App\Jobs;

use App\Actors;
use App\Jobs\Job;
use App\Movies;
use App\Results;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class ValidateResults extends Job
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    public $model;
    public $results;

    public $correct;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Results $results)
    {
        $this->model = $results;
        $this->results = json_decode($results->results);

        $this->model->validated = 1;
        $this->model->save();

        $this->correct = $this->model->correct;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //want the current Id in the last result movie
        for($i = 1; $i < (count($this->results)); $i++) {

            $current = $this->results[$i];
            $prev = $this->results[$i-1];

            $currentCache = $this->returnCache($current);
            $prevCache = $this->returnCache($prev);

            $this->results[$i]->correct = $this->loopThroughCredits($prevCache->cast, $current->id);


            $this->results[$i]->class = $this->addClass($this->results[$i]->correct);

        }

        // last element
        $this->validate();
        $this->model->results = json_encode($this->results);

        return $this->model;
    }

    public function validate()
    {
        $this->validateLast();


        $this->checkIfCorrect();


        //TODO add the correct
        // $this->finalCorrect();
    }

    protected function validateLast()
    {
        $game = $this->model->game;

        $last = end($this->results);
        $key = key($last);


        if(!((int)$game->end === $last->id && $game->end_type === $last->type)){
            $this->results[$key] = $this->addClass('wtf');
            $this->correct = 0;
        }
    }


    protected function finalCorrect()
    {
        if($this->correct !== 0 || $this->correct === null){
            $this->correct = 1;
            $this->model->correct = $this->correct;
            $this->model->save();
        }
    }

    protected function returnCache($result)
    {
        $key = $result->type.'/'.$result->id.'/credits';

        $cache = $this->getCache($key);

        if(empty($cache)){
            $model = $this->getClass($result->type);

            $this->dispatch(new CacheFind($model, $result->id));

            $cache = $this->getCache($key);
        }

        return $cache;
    }

    private function getClass($type)
    {
        switch ($type){
            case 'movie':
                return new Movies();
                break;
            case 'person':
                return new Actors();
                break;
        }
    }

    protected function getCache($key)
    {
        return Cache::get($key);
    }

    /**
     * @param $credits
     * @param $nextId
     * @return bool
     */
    protected function loopThroughCredits($credits, $nextId)
    {
        foreach($credits as $credit){
            if($credit->id === $nextId){
                return true;
            }
        }

        return false;
    }

    protected function addClass($bool)
    {

        switch ($bool){
            case true:
                return 'corrent';
            case 'wtf':
                return 'wtf';
            default:
                return 'wrong';

        }
    }

    protected function checkIfCorrect()
    {
        foreach($this->results as $result){
            if(property_exists($result, 'correct')){
                if($result->correct !== true){
                    $this->correct = 0;
                    break;
                }
            }
        }
    }

}
