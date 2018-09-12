<?php

namespace App\Events;

use App\Notifications;
use App\RideOffers;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OfferCreated implements  ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $msg, $ad_link, $rec;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $offer_by = User::find($data['from']);
        $offer = RideOffers::find($data['ride_id']);
        $msg = '<a href="#">'.$offer_by->name.'</a> has created an offer on your ride request.';
        $link = url('/ride-details/'.$offer->link);
        $not = new Notifications();
        $not->from = $data['from'];
        $not->to = $data['to'];
        $not->message = $msg;
        $not->ad_link = $link;
        $not->status = 'unread';
        if($not->save()){
            $this->msg = $msg;
            $this->ad_link = $link;
            $this->rec = $data['to'];
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['offer-created'];
    }
}
