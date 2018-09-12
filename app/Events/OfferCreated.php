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

    public $msg, $ad_link, $rec, $time_at, $ev;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        if($data['event'] == 'offer-created'){
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
                $this->ev = 'offer-created';
                $this->msg = $msg;
                $this->ad_link = $link;
                $this->rec = $data['to'];
                $this->time_at = date('d M Y', strtotime($not->created_at)).' at '.date('H:i', strtotime($not->created_at));
            }
        }

        if($data['event'] == 'ride-request'){
            $req_by = User::find($data['from']);
            $recs = array();
            $drivers = User::where(['role' => 'driver'])->get();
            foreach($drivers as $driver){
                $not = new Notifications();
                $not->from = $data['from'];
                $not->to = $driver->id;
                $not->message = '<a href="#">'.$req_by->name.'</a> has requested for a ride.';
                $not->ad_link = url('/d/offer-ride?req='.$data['req_id']);
                $not->status = 'unread';
                if($not->save()){
                    $recs[] = $driver->id;
                }
            }
            $this->ev = 'ride-request';
            $this->msg = $req_by->name.' has requested for a ride.';
            $this->ad_link = url('/d/offer-ride?req='.$data['req_id']);
            $this->rec = $recs;
            $this->time_at = date('d M Y').' at '.date('H:i');
        }

        if($data['event'] == 'ride-booked'){
            $by = User::find($data['from']);
            $offer = RideOffers::find($data['offer_id']);
            $offer_by = User::find($offer->offer_by);
            $not = new Notifications();
            $not->from = $data['from'];
            $not->to = $offer->offer_by;
            $not->message = '<a href="#">'.$by->name.'</a> has booked your ride offer.';
            $not->ad_link = url('/ride-details/'.$offer->link);
            $not->status = 'unread';
            if($not->save()){
                $this->ev = 'ride-booked';
                $this->msg = $not->message;
                $this->ad_link = $not->ad_link;
                $this->rec = $offer_by->id;
                $this->time_at = date('d M Y', strtotime($not->created_at)).' at '.date('H:i', strtotime($not->created_at));
            }
        }

        if($data['event'] == 'booking-accepted'){
            $offer = $data['offer'];
            $booking = $data['booking'];
            $offer_by = User::find($data['from']);
            $not = new Notifications();
            $not->from = $data['from'];
            $not->to = $booking->user_id;
            $not->message = '<a href="#">'.$offer_by->name.'</a> has accepted your ride booking.';
            $not->ad_link = url('/ride-details/'.$offer->link);
            $not->status = 'unread';
            if($not->save()){
                $this->ev = 'ride-booked';
                $this->msg = $not->message;
                $this->ad_link = $not->ad_link;
                $this->rec = $not->to;
                $this->time_at = date('d M Y', strtotime($not->created_at)).' at '.date('H:i', strtotime($not->created_at));
            }
        }

        if($data['event'] == 'booking-canceled'){
            $booking = $data['booking'];
            $offer = RideOffers::find($booking->ride_id);
            $offer_by = User::find($data['from']);
            $not = new Notifications();
            $not->from = $data['from'];
            $not->to = $booking->user_id;
            $not->message = '<a href="#">'.$offer_by->name.'</a> has canceled your ride booking.';
            $not->ad_link = url('/ride-details/'.$offer->link);
            $not->status = 'unread';
            if($not->save()){
                $this->ev = 'ride-booked';
                $this->msg = $not->message;
                $this->ad_link = $not->ad_link;
                $this->rec = $not->to;
                $this->time_at = date('d M Y', strtotime($not->created_at)).' at '.date('H:i', strtotime($not->created_at));
            }
        }

        if($data['event'] == ''){}

        if($data['event'] == ''){}

        if($data['event'] == ''){}

        if($data['event'] == ''){}

        if($data['event'] == ''){}
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
