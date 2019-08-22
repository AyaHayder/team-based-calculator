<?php

namespace App\Listeners;

use App\Events\PendingTicketsEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PendingTicketsEventListener
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
     * @param  PendingTicketsEvent  $event
     * @return void
     */
    public function handle(PendingTicketsEvent $event)
    {
        //
    }
}
