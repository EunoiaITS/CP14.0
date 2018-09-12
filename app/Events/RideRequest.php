<?php

namespace App\Events;

use App\Notifications;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RideRequest
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $msg, $ad_link, $rec, $time_at;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $req_by = User::find($data['from']);
        $recs = array();
        $drivers = User::where(['role' => 'driver'])->get();
        foreach($drivers as $driver){
            $not = new Notifications();
            $not->from = $data['from'];
            $not->to = $driver->id;
            $not->message = $req_by->name.' has requested for a ride.';
            $not->ad_link = url('/d/offer-ride?req='.$data['req_id']);
            $not->status = 'unread';
            if($not->save()){
                $recs[] = $driver->id;
            }
        }
        $this->msg = $req_by->name.' has requested for a ride.';
        $this->ad_link = url('/d/offer-ride?req='.$data['req_id']);
        $this->rec = $recs;
        $this->time_at = date('d M Y').' at '.date('H:i');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['ride-request'];
    }
}
