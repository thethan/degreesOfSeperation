<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\TMDBModel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class CacheCredits extends Job
{

    protected $model ;
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TMDBModel $model )
    {
        $this->model = $model;


    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $body = $this->model->setCredits($this->model->id);
        $this->model->body = $body;
        $class = get_class($this->model);
        $name = $this->model->uri();

        Cache::put($name, $body   , 4000);

        return $this->model->body;
    }
}
