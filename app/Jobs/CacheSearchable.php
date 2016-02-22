<?php

namespace selftotten\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use selftotten\TMDBModel;

class CacheSearchable extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $model;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TMDBModel $model)
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
        $body = $this->model->search($this->id);
        $this->model->body = $body;
        $class = get_class($this->model);
        $name = 'person_'.$this->model->id;

        Cache::put($name, $body , 4000);
        return $this->model->body;
    }
}
