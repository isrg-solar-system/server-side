<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WarningBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    protected $dataname;
    protected $status;
    protected $value;

    public function __construct($dataname,$status,$value)
    {
        //
        $this->dataname = $dataname;
        $this->status = $status;
        $this->value = $value;
    }

    public function broadcastWith()
    {
        return ['dataname'=>$this->dataname,'status'=>$this->status,'value'=>$this->value];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['publicchannel'];
    }

    public function broadcastAs() {
        return 'warning';
    }
}
