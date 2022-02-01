<?php

namespace App\Listeners;

use App\Events\ActiveCall;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ShowConsultationPage
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
     * @param  ActiveCall  $event
     * @return void
     */
    public function handle(ActiveCall $event)
    {
        if($event->number != null && $event->doctor_id != null)
        {
             // call the second handler or return it as result
             return true;
        }
        
        echo 'no phone number and doctor id';
        return false;
    }
}
