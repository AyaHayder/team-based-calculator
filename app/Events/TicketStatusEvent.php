<?php

namespace App\Events;

use App\Ticket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TicketStatusEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $tickets;
    public function __construct($tickets)
    {
        $this->tickets = $tickets;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('ticket-processing');
    }

    public function broadcastWith()
    {
        $pending=Ticket::where('is_pending', '=', true)->count();
        $archived=Ticket::where('is_pending', '=', false)->count();
        $total = Ticket::all()->count();
        $extra = [
            'pending'=>$pending,
            'archived'=>$archived,
            'total' =>$total
        ];
        $data=array($this->tickets);
        return array_merge($data,$extra);
    }
}
