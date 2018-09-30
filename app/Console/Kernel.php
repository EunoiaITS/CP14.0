<?php

namespace App\Console;

use App\Ride_request;
use App\RideBookings;
use App\RideDescriptions;
use App\RideOffers;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Events\OfferCreated;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){
            $active_offers = RideOffers::where(['status' => 'active'])
                ->get();
            foreach($active_offers as $ac){
                if(date('Y-m-d H:i') >= date('Y-m-d H:i', strtotime($ac->departure_time)+3600)){
                    $ac->status = 'expired';
                    if($ac->save()){
                        event(new OfferCreated([
                            'event' => 'ride-expired',
                            'ride_id' => $ac->id
                        ]));
                    }
                }
            }
            $expired_offers = RideOffers::where(['status' => 'expired'])->get();
            foreach($expired_offers as $ex){
                RideOffers::destroy($ex->id);
                $descs = RideDescriptions::where('ride_offer_id', $ex->id)->get();
                foreach($descs as $del){
                    RideDescriptions::destroy($del->id);
                }
            }
            $active_req = Ride_request::where(['status' => 'requested'])->get();
            foreach($active_req as $req){
                if(date('Y-m-d H:i') >= date('Y-m-d H:i', strtotime($req->departure_date))){
                    $req->status = 'expired';
                    if($req->save()){
                        event(new OfferCreated([
                            'event' => 'req-expired',
                            'req_id' => $req->id
                        ]));
                    }
                }
            }
            $in_progress = RideOffers::where('status', 'in-progress')
                ->where('arrival_time', '<=', date('Y-m-d H:i:s'))
                ->get();
            foreach ($in_progress as $inp){
                $inp->status = 'completed';
                if($inp->save()){
                    event(new OfferCreated([
                        'event' => 'ride-end',
                        'from' => $inp->offer_by,
                        'ride_id' => $inp->id
                    ]));
                }
            }
            $ex_req = Ride_request::where(function($q){
                $q->where(['status' => 'expired'])
                    ->orWhere(['status' => 'canceled']);
            })->get();
            foreach($ex_req as $er){
                Ride_request::destroy($er->id);
            }
            $bookings = RideBookings::where(['status' => 'canceled'])->get();
            foreach($bookings as $b){
                RideBookings::destroy($b->id);
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
