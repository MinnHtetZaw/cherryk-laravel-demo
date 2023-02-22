<?php

namespace App\Listeners;

use App\Events\AppointmentProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAppointmentNotification
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
     * @param  \App\Events\AppointmentProcessed  $event
     * @return void
     */
    public function handle(AppointmentProcessed $event)
    {
        //
    }
}
