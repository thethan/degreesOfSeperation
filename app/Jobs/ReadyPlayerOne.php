<?php

namespace App\Jobs;

use App\Game;
use Illuminate\Support\Facades\Auth;
use App\Jobs\Job;
use App\Results;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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

        $this->resultsModel->gameStart($this->gameModel);

        $this->resultsModel->save();

        return $this->resultsModel;
    }
}
