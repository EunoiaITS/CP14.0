<?php

namespace App\Listeners;

use App\Events\Event;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class LoginListener
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
    public function handle(Event $event, Request $request)
    {
        $check_area = session('area');
        if(!isset($check_area) &&  !in_array($request->url(), [url('/choose-country')])){
            redirect()->to('/choose-country');
        }
    }
}
