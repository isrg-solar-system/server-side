<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class InputData implements ShouldBroadcast

{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $data;
    public $broadcastQueue = 'broadcastQueue';

    public function __construct($data)
    {
        //
        $this->data = array(
            'data'=> $data
        );
        echo $data;
    }


    public function broadcastWith()
    {
        return $this->data;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        #return new PrivateChannel('channel-name');
        return ['receive'];
    }

    public function broadcastAs() {
        return 'inputdata';
    }
}
