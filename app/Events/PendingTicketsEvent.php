<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PendingTicketsEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $ticket;
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('pending-ticket');
    }

    public function broadcastWith()
    {
        foreach ($this->ticket->station as $station){
            if($this->ticket->station_id == $station->id){
                $value = $station->value;
                $name = $station->name;
            }
            else{
                $value = 100;
                $name = null;
            }
        }
        $extra = [
            'station_value' => $value,
            'station_name' => $name,
        ];
        return array_merge($this->ticket->toArray(),$extra);
    }
}
