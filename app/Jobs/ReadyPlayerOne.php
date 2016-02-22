<?php

namespace selftotten\Jobs;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use selftotten\Game;
use selftotten\Results;

class ReadyPlayerOne extends Job
{
    use InteractsWithQueue, SerializesModels;

    public $gameModel, $resultsModel, $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Game $model, $resultId = null)
    {
        $this->gameModel = $model;
        $this->resultsModel = Results::findOrNew($resultId);


        $this->resultsModel->user_id = Auth::user()->id;
        $this->resultsModel->game_id = $model->id;

        $this->id = $resultId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->gameModel->getItemsForViewing();

        if(empty($this->resultsModel->results) ){
            $this->resultsModel->gameStart($this->gameModel);
            $this->resultsModel->save();
        }

        return $this->resultsModel;
    }
}
