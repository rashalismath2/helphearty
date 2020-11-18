<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InitCall implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    private $user_type;
    private $toId="";

    public function __construct($user,$user_type,$toId)
    {
        $this->user=$user;
        $this->user_type=$user_type;
        $this->toId=$toId;
    }

       /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //if this is the acceptance from the consultant to user for their call
        if($this->toId!==""){
            return new PrivateChannel('acceptCall-toId-'.$this->toId);
        }
        //this is for initiating call from user
        if($this->user_type==="user"){
            return new PrivateChannel('CallFrom-'.$this->user_type."-toId-".$this->user->consultant_id);            
        }
    }
}
