<?php

namespace selftotten\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class DegreeSaved extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $data, $degrees, $gameId, $userId, $resultId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId, $dos, $gameId = null, $resultId = null)
    {
        $this->gameId = $gameId;
        $this->userId = $userId;
        $this->resultId = $resultId;

        $this->data = array(
            'dos' => $dos,
        );
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {

        return ['user_'.$this->userId .'', "user_$this->userId" . "_game_$this->gameId", 'game_'.$this->gameId, 'user_63', 'result_'.$this->resultId, 'test-channel'];
    }
}
