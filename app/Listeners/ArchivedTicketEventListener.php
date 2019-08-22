<?php

namespace App\Listeners;

use App\Events\ArchivedTicketEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArchivedTicketEventListener
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
     * @param  ArchivedTicketEvent  $event
     * @return void
     */
    public function handle(ArchivedTicketEvent $event)
    {
        //
    }
}
