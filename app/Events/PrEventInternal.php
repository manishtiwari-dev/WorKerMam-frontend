<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use ApiHelper;

class PrEventInternal implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $message;
    
    public function __construct($message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        $db_user_id = ApiHelper::db_user_id();
        return ['pr-channel-'.$db_user_id];
    }

    public function broadcastAs()
    {
        return 'pr-channel-admin';
    }

    public function broadcastWith()
    {
        return ['KEY' => $this->message];
    }
}
