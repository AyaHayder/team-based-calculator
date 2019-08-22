<?php

namespace App\Listeners;

use App\Events\TicketStatusEvent;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketStatusEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TicketStatusEvent  $event
     * @return void
     */
    public function handle(TicketStatusEvent $event)
    {
        //
    }
}
