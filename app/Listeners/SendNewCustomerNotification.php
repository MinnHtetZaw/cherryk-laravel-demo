<?php

namespace App\Listeners;

use App\Events\CustomerRegister;
use App\Models\User;
use App\Notifications\NewCustomerNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewCustomerNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle(CustomerRegister $event)
    {
        $admins = User::where('role',0)->get();
        Notification::send($admins, new NewCustomerNotification($event->customer));
    }
}
