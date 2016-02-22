<?php

namespace selftotten\Jobs;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use selftotten\Actors;
use selftotten\Movies;
use selftotten\Results;

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
        for ($i = 1; $i < (count($this->results)); $i++) {

            $current = $this->results[$i];
            $prev = $this->results[$i - 1];

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

    protected function returnCache($result)
    {
        $key = $result->type . '/' . $result->id . '/credits';

        $cache = $this->getCache($key);

        if (empty($cache)) {
            $model = $this->getClass($result->type);

            $this->dispatch(new CacheFind($model, $result->id));

            $cache = $this->getCache($key);
        }

        return $cache;
    }

    protected function getCache($key)
    {
        return Cache::get($key);
    }

    private function getClass($type)
    {
        switch ($type) {
            case 'movie':
                return new Movies();
                break;
            case 'person':
                return new Actors();
                break;
        }
    }

    /**
     * @param $credits
     * @param $nextId
     * @return bool
     */
    protected function loopThroughCredits($credits, $nextId)
    {
        foreach ($credits as $credit) {
            if ($credit->id === $nextId) {
                return true;
            }
        }

        return false;
    }

    protected function addClass($bool)
    {
        if ($bool === true) {
            return ' correct';
        } else if ($bool === 'wtf') {
            return ' wtf';
        } else {
            return ' wrong';
        }


    }

    public function validate()
    {
        $this->validateLast();


        $this->checkIfCorrect();

        $this->finalCorrect();
    }

    protected function validateLast()
    {
        $game = $this->model->game;

        $last = last($this->results);
        end($this->results);
        $key = key($this->results);


        if (!((int)$game->end === $last->id && $game->end_type === $last->type)) {
            $this->results[$key]->class .= ' ' . $this->addClass('wtf');
            $this->correct = 0;
        }
    }

    protected function checkIfCorrect()
    {
        foreach ($this->results as $result) {
            if (property_exists($result, 'correct')) {
                if ($result->correct !== true) {
                    $this->correct = 0;
                    break;
                }
            }
        }
    }

    protected function finalCorrect()
    {
        if ($this->correct === null) {
            $this->correct = 1;
            $this->model->correct = $this->correct;
            $this->model->save();
        }
    }

}
