<?php

namespace selftotten\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class EventName extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $data;

    public function __construct()
    {
        $this->data = array(
            'power'=> '10', 'userId' => '14'
        );
    }

    public function broadcastOn()
    {
        return ['test-channel'];
    }
}