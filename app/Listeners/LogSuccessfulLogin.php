<?php
namespace App\Listeners;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Auth;
use Carbon\Carbon;
use Config;
class LogSuccessfulLogin
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $type = Auth::user()->type;
        $dtm = Carbon::now(Config::get('app.timezone'));
        $user = User::find(Auth::id());
        $user->last_login = $dtm;
        if ($type == 'Admin' || $type == 'Student') {
            $user->save();
        } elseif ($type == 'Coordinator') {
            if (Auth::user()->last_login != null) {
                $user->save();
            }
        }
    }
}
