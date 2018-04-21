<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DownloadStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $user;
    protected $data;
//    public $broadcastQueue = 'broadcastQueue';

    public function __construct($user,$data)
    {
        //
        print_r($data);
        $this->user = $user;
        $this->data = $data;
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
        return new PrivateChannel('download.'.$this->user->id);
//        return ['publicchannel'];
    }

    public function broadcastAs() {
        return 'status';
    }
}
