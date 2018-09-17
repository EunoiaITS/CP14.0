<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BookingAccepted implements  ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $msg, $ad_link, $rec, $time_at;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->msg = 'Toki has requested for a ride.';
        $this->ad_link = url('/d/offer-ride');
        $this->rec = ['1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $this->time_at = date('d M Y').' at '.date('H:i');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['booking-accepted'];
    }
}
