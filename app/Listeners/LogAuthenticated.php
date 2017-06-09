<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Event;
use Carbon\Carbon;
use Config;
class LogAuthenticated
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
     * @param  Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        $events = Event::where('date_held','<',Carbon::today(Config::get('app.timezone')))->get();
        foreach ($events as $finish) {
            if ($finish->status == 'Ongoing')
                $finish->status = 'Done';
            $finish->save();
        }
    }
}
