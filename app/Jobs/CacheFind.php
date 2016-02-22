<?php

namespace selftotten\Jobs;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use selftotten\TMDBModel;

class CacheFind extends Job
{

    protected $model, $id ;

    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TMDBModel $model, $id = null)
    {
        $this->model = $model;
        $this->id = $id;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $body = Cache::get($this->model->uri() . '/'. $this->id);

        if(!$body) {
            $body = $this->model->find($this->id);
            $this->model->body = $body;
            $class = get_class($this->model);
            $name = $this->model->uri();

            Cache::put($name, $body, 4000);

            $this->dispatch(new CacheCredits($this->model));
        }

        return $body;
        //$this->release(10);
    }
}
