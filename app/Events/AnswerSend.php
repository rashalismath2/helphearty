<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AnswerSend implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

  
    public $user;
    public $answer;
    private $toId;
    private $user_type;

    public function __construct($answer,$user,$user_type,$toId)
    {
        $this->answer=$answer;
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
        if($this->user_type=="user"){
            return new PrivateChannel('offerFrom-'.$this->user_type."-toId-".$this->user->consultant_id);            
        }
        return new PrivateChannel('answerFrom-'.$this->user_type."-toId-".$this->toId);

    }
}
