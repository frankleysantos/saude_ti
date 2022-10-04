<?php

namespace App\Listeners;

use App\Events\NewUser;
use App\Mail\EmailNewUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailNewUser
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
     * @param  \App\Events\NewUser  $event
     * @return void
     */
    public function handle(NewUser $event)
    {
        Mail::to($event->user['email'])
                ->send(new EmailNewUser($event->user));
    }
}
