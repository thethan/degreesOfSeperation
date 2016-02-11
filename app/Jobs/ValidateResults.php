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

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        for($i = 1; $i < (count($this->results) -1); $i++) {
            $next = $this->results[$i+1];
            $current = $this->results[$i];

            $currentCache = $this->returnCache($current);

            $return = $this->loopThroughCredits($currentCache->cast, $next->id);

            $this->results[$i]->class = $this->addClass($return);
        }
        // last element

        $this->results[$i]->class = $this->addClass($return);

        $this->model->results = json_encode($this->results);

        return $this->model;
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
        if($bool){
            return 'correct';
        }
        return 'wrong';
    }

}
