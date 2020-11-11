<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

use App\Models\Message;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    private $user_type;

    public function __construct(Message $message,$user,$user_type)
    {
        $this->message=$message;
        $this->user=$user;
        $this->user_type=$user_type;


    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        if($this->user_type=="user"){
            return new PrivateChannel('messageFrom-'.$this->user_type."-toId-".$this->message->consultant_id);            
        }
        return new PrivateChannel('messageFrom-'.$this->user_type."-toId-".$this->message->user_id);
    }
}
