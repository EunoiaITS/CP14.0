<?php

namespace App\Http\Controllers;

use App\Ride_request;
use App\RideBookings;
use App\RideDescriptions;
use App\VehiclesData;
use Illuminate\Http\Request;
use App\User;
use App\User_data;
use App\RideOffers;
use App\DriverData;
use App\GuestRequests;
use App\RideRequestTemp;
use Auth;

class Frontend extends Controller
{

    /**
     * Home - homepage of the system
    */
    public function home(Request $request){
        $reqs = Ride_request::where('departure_date', '>=', date('Y-m-d'))
            ->get();
        foreach($reqs as $req){
            $user = User::find($req->user_id);
            $user_data = User_data::where(['user_id' => $req->user_id])->first();
            $req->user_details = $user;
            $req->user_data = $user_data;
            if(Auth::check()){
                $ex_offers = RideOffers::where(['request_id' => $req->id])
                    ->where('offer_by', '!=', 'NULL')
                    ->first();
                if($ex_offers){
                    $req->exx = 'yes';
                }
            }
        }
        $offers_today = RideOffers::whereDate('departure_time', '<=', date('Y-m-d'))
            ->where(['status' => 'active'])
            ->get();
        foreach($offers_today as $of){
            $user_of = User::find($of->offer_by);
            $user_data_of = User_data::where(['user_id' => $of->offer_by])->first();
            $of->user_details = $user_of;
            $of->user_data = $user_data_of;
            $bookings = RideBookings::where(['ride_id' => $of->id])
                ->where(function($q){
                    $q->where(['status' => 'booked'])
                        ->orWhere(['status' => 'confirmed']);
                })
                ->get();
            $of->bookings = $bookings;
        }
        return view('frontend.pages.home', [
            'reqs' => $reqs,
            'offers' => $offers_today,
            'slug' => 'home',
            'modals' => 'frontend.pages.modals.home-modals',
            'js' => 'frontend.pages.js.home-js'
        ]);
    }

    public function popular(Request $request){
        $ro = RideOffers::where(['status' => 'active'])
            ->paginate(3);
        foreach ($ro as $r){
            $user = User::find($r->offer_by);
            $r->user = $user;
            $usd = User_data::where('user_id',$r->offer_by)->first();
            $r->usd = $usd;
            $dd = DriverData::where('user_id',$r->offer_by)->first();
            $r->dd = $dd;
        }
        return view('frontend.pages.popular',[
            'data' => $ro
        ]);
    }

    public function rideDetails(Request $request,$link){
        $ro = RideOffers::where('link',$link)->first();
        $rd = RideDescriptions::where('ride_offer_id',$ro->id)->get();
        $ro->rd = $rd;
        $user = User::where('id', $ro->offer_by)->first();
        $ro->user = $user;
        $usd = User_data::where('user_id', $ro->offer_by)->first();
        $ro->usd = $usd;
        $vehicle = '';
        foreach($rd as $r){
            if($r->key == 'vehicle_id'){
                $vehicle = $r->value;
            }
        }
        $vd = VehiclesData::find($vehicle);
        $ro->vd = $vd;
        $bookings = RideBookings::where(['ride_id' => $ro->id])
            ->where(function($q){
                $q->where(['status' => 'booked'])
                    ->orWhere(['status' => 'confirmed']);
            })
            ->get();
        foreach($bookings as $book){
            $requester = User::find($book->user_id);
            $book->requester = $requester;
            $ud = User_data::where(['user_id' => $book->user_id])->first();
            $book->ud = $ud;
        }
        $ro->bookings = $bookings;
        return view('frontend.pages.ride-details',[
            'data' => $ro,
            'js' => 'frontend.pages.js.ride-details-js',
            'modals' => 'frontend.pages.modals.ride-details-modals'
        ]);
    }
    public function guestRequests(Request $request){
        $gr = new GuestRequests();
        $gr->ride_offer_id = $request->ride_offer_id;
        $gr->token = $request->token;
        $gr->status = 'processing';
        $gr_id = $gr->id;
        if($gr->save()){
            return redirect('/sign-up/customer/')
                ->with('gr_id',$gr_id);
        }else{
            return redirect()
                ->back();
        }
    }
    /**
     * Search - Search functionality of the system
     */

    public function search(Request $request){
        if($request->isMethod('post')){
            //dd($request->all());
            $search_data = RideOffers::
                Where('departure_time', '<=', date('Y-m-d H:i:s',strtotime($request->when)))
                ->orWhere('origin', 'like', '%'. trim($request->from) .'%')
                ->orWhere('destination' , 'like' , '%'. trim($request->to) .'%')
                ->orWhere('total_seats' , '<=' , $request->seats)
                ->orderBy('created_at', 'desc')
                ->get();
            if(!$search_data->first()){
                $search_data->error = "Your Desired Search Result Not Found !!";
                return view('frontend.pages.search-result',[
                    'data' => $search_data,
                    'time' => $request->when
                ]);
            }else{
                foreach ($search_data as $sd){
                    $user = User::where('id',$sd->offer_by)->first();
                    $sd->user = $user;
                    $usd = User_data::where('user_id',$sd->offer_by)->first();
                    $sd->usd = $usd;
                }
                return view('frontend.pages.search-result',[
                    'data' => $search_data,
                    'time' => $request->when
                ]);
            }
        }
        return view('frontend.pages.search',[
            'js' => 'frontend.pages.js.home-js'
        ]);
    }
    /**
     * About Us page - About Us page of the system
     */
    public function aboutUs(){
        return view('frontend.pages.about-us');
    }

    /**
     * Terms page - terms page of the system
     */
    public function terms(){
        return view('frontend.pages.terms');
    }

    /**
     * Contact us page - Contact us page of the system
     */
    public function ContactUs(){
        return view('frontend.pages.contact-us');
    }

    /**
     * Copyright page - Copyright us page of the system
     */
    public function Copyright(){
        return view('frontend.pages.copyright');
    }

    /**
     * non-discrimination page - non-discrimination page of the system
     */
    public function nonDiscrimination(){
        return view('frontend.pages.non-discrimination');
    }

    /**
     * privacy-policy page - privacy-policy us page of the system
     */
    public function privacyPolicy(){
        return view('frontend.pages.privacy-policy');
    }
}
