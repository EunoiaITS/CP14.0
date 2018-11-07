<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Countries;
use App\Notifications;
use App\Ratings;
use App\Ride_request;
use App\RideBookings;
use App\RideComp;
use App\RideDescriptions;
use App\UsersExtendedData;
use App\VehiclesData;
use App\VerifyUsers;
use Illuminate\Http\Request;
use App\User;
use App\User_data;
use App\RideOffers;
use App\DriverData;
use App\GuestRequests;
use App\RideRequestTemp;
use Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Frontend extends Controller
{

    public function __construct(){
        $this->middleware('Guest');
    }

    /**
     * Home - homepage of the system
    */
    public function home(Request $request){
        $reqs = Ride_request::where('departure_date', '>=', date('Y-m-d'))
            ->where(['status' => 'requested'])
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
        $offers_today = RideOffers::whereDate('departure_time', '=', date('Y-m-d'))
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
            $rating = Ratings::where('to', $of->offer_by)->get();
            $count = Ratings::where('to', $of->offer_by)->count();
            $avg = 0;
            foreach ($rating as $ra) {
                $avg += $ra->rating;
            }
            if ($count != 0) {
                $of->average = $avg / $count;
            }
        }
        return view('frontend.pages.home', [
            'reqs' => $reqs,
            'offers' => $offers_today,
            'slug' => 'home',
            'not' => Notifications::all(),
            'modals' => 'frontend.pages.modals.home-modals',
            'js' => 'frontend.pages.js.home-js'
        ]);
    }

    public function chooseCountry(Request $request){
        $countries = Countries::all()->sortBy('name');
        if($request->session()->has('area')){
            return redirect()
                ->to('/')
                ->with('error', 'You can\'t access this page!');
        }
        if($request->isMethod('post')){
            $countries = explode(',', $request->country);
            if(Auth::check()){
                for($i = 0; $i < sizeof($countries); $i++){
                    $c_data = new UsersExtendedData();
                    $c_data->user_id = Auth::id();
                    if($i == 0){
                        $c_data->key = 'country';
                    }elseif($i == 1){
                        $c_data->key = 'lat';
                    }elseif($i == 2){
                        $c_data->key = 'lan';
                    }else{
                        $c_data->key = 'key'.$i;
                    }
                    $c_data->value = $countries[$i];
                    $c_data->save();
                }
                $cd = UsersExtendedData::where(['user_id' => Auth::id()])->get();
                if(!empty($cd)){
                    foreach($cd as $c){
                        if($c->key == 'country'){
                            session(['area' => $c->value]);
                        }
                        if($c->key == 'lat'){
                            session(['lat' => $c->value]);
                        }
                        if($c->key == 'lan'){
                            session(['lan' => $c->value]);
                        }
                    }
                }
            }else{
                session(['area' => $countries[0]]);
                session(['lat' => $countries[1]]);
                session(['lan' => $countries[2]]);
            }
            return redirect()
                ->to('/');
        }
        return view('frontend.pages.choose-country', [
            'countries' => $countries
        ]);
    }

    /**
     * Popular - function to show all the popular rides
     * param - $opt - 4 options - all, dest, ridemates, req-loc - default(all)
    */
    public function popular(Request $request, $opt){
        $page = null;
        if(isset($request->page)){
            $page = $request->page;
        }
        $ro = RideOffers::where(['status' => 'completed'])
            ->orderBy('departure_time','desc')
            ->get();
        $dests = $drivers = $req_locs = array();
        $dests_unique = $drivers_unique = $req_locs_unique = array();

        if($opt == 'dest'){
            foreach($ro as $r){
                $dests[] = $r->destination;
            }
            $dests_unique = array_count_values($dests);
            foreach($ro as $k => $r){
                $ro->pull($k);
            }
            foreach($dests_unique as $k => $v){
                $rides = RideOffers::where(['status' => 'completed'])
                    ->where('destination', $k)
                    ->orderBy('departure_time','desc')
                    ->get();
                foreach($rides as $ride){
                    $ro->push($ride);
                }
            }
            //dd($ro);
        }

        if($opt == 'ridemates'){
            foreach($ro as $r){
                $drivers[] = $r->offer_by;
            }
            $drivers_unique = array_count_values($drivers);
            foreach($ro as $k => $r){
                $ro->pull($k);
            }
            foreach($drivers_unique as $k => $v){
                $rides = RideOffers::where(['status' => 'completed'])
                    ->where('offer_by', $k)
                    ->orderBy('departure_time','desc')
                    ->get();
                foreach($rides as $ride){
                    $ro->push($ride);
                }
            }
            //dd($ro);
        }

        if($opt == 'req-loc'){
            $ro = RideOffers::where(['status' => 'completed'])
                ->where('request_id', '!=', 0)
                ->orderBy('departure_time','desc')
                ->get();
            foreach($ro as $r){
                $req_locs[] = $r->destination;
            }
            $req_locs_unique = array_count_values($req_locs);
            foreach($ro as $k => $r){
                $ro->pull($k);
            }
            foreach($req_locs_unique as $k => $v){
                $rides = RideOffers::where(['status' => 'completed'])
                    ->where('destination', $k)
                    ->where('request_id', '!=', 0)
                    ->orderBy('departure_time','desc')
                    ->get();
                foreach($rides as $ride){
                    $ro->push($ride);
                }
            }
            //dd($ro);
        }

        foreach ($ro as $r){
            $user = User::find($r->offer_by);
            $r->user = $user;
            $usd = User_data::where('user_id', $r->offer_by)->first();
            $r->usd = $usd;
            $dd = DriverData::where('user_id', $r->offer_by)->first();
            $r->dd = $dd;
            $rating = Ratings::where('to', $r->offer_by)->get();
            $count = Ratings::where('to', $r->offer_by)->count();
            $avg = 0;
            foreach ($rating as $ra) {
                $avg += $ra->rating;
            }
            if ($count != 0) {
                $r->average = $avg / $count;
            }
        }
        return view('frontend.pages.popular',[
            'data' => $this->paginate($ro, 10, $page),
            'opt' => $opt
        ]);
    }

    public function paginate($items, $perPage = 10, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }

    public function rideDetails(Request $request,$link){
        $ro = RideOffers::where('link', $link)->first();
        if(empty($ro)){
            abort(404);
        }
        $ratings = Ratings::where('to',$ro->offer_by)->get();
        $count = Ratings::where('to',$ro->offer_by)->count();
        $avg = 0;
        foreach ($ratings as $r){
            $avg += $r->rating;
        }
        if($count != 0){
            $ro->average = $avg/$count;
        }
        if($ro->status == 'expired' || $ro->status == 'canceled'){
            return redirect()
                ->to('/')
                ->with('error', 'This ride was canceled/expired!');
        }
        $rideStart = RideComp::where(['ride_id' => $ro->id])->first();
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
        $rates = $rate_tos = array();
        $ratings = Ratings::where('ride_id', $ro->id)->get();
        foreach($ratings as $rate){
            $rates[] = $rate->from;
            $rate_tos[] = $rate->to;
        }
        return view('frontend.pages.ride-details',[
            'data' => $ro,
            'ride_start' => $rideStart,
            'rates' => $rates,
            'rate_tos' => $rate_tos,
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
            $search_data = RideOffers::where('status','=','active')
                ->where('departure_time', '>=', date('Y-m-d H:i:s',strtotime($request->when)))
                ->where(function($q) use ($request){
                    $q->where('origin','like','%' . $request->from . '%')
                      ->orWhere('destination','like','%' . $request->to . '%');
                })
                ->orderBy('created_at', 'desc')
                ->get();
            if(!$search_data->first()){
                $search_data->error = "Whooops, your desired ride is not available at the moment. Please try again.";
                return view('frontend.pages.search',[
                    'data' => $search_data,
                    'time' => $request->when,
                    'js' => 'frontend.pages.js.home-js'
                ]);
            }else{
                foreach ($search_data as $sd){
                    $user = User::where('id',$sd->offer_by)->first();
                    $sd->user = $user;
                    $usd = User_data::where('user_id',$sd->offer_by)->first();
                    $sd->usd = $usd;
                    $bookings = RideBookings::where(['ride_id' => $sd->id])
                        ->where(function($q){
                            $q->where(['status' => 'booked'])
                                ->orWhere(['status' => 'confirmed']);
                        })
                        ->get();
                    $sd->bookings = $bookings;
                    $rating = Ratings::where('to',$sd->offer_by)->get();
                    $count = Ratings::where('to',$sd->offer_by)->count();
                    $avg = 0;
                    foreach ($rating as $ra){
                        $avg += $ra->rating;
                    }
                    if($count != 0){
                        $sd->average = $avg / $count;
                    }

                }
                return view('frontend.pages.search',[
                    'data' => $search_data,
                    'time' => $request->when,
                    'js' => 'frontend.pages.js.home-js'
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
        return view('frontend.pages.terms',[
            'js' => 'frontend.pages.js.terms-js'
        ]);
    }

    /**
     * Contact us page - Contact us page of the system
     */
    public function ContactUs(Request $request){
        $errors = array();
        $cont = new Contact();
        if($request->isMethod('post')){
            if(!$cont->validate($request->all())){
                $cont_e = $cont->errors();
                foreach ($cont_e->messages() as $k => $v){
                    foreach ($v as $e){
                        $errors[] = $e;
                    }
                }
            }
            if(empty($errors)){
                $cont->name = $request->name;
                $cont->email = $request->email;
                $cont->message = $request->message;
                $cont->save();
                    return redirect()
                        ->to('/contact-us')
                        ->with('success','Your Message Is Sent, We Hear You !!');
            }else{
                return redirect()
                    ->to('/contact-us')
                    ->with('error','Your Message Can Not Be Sent, Please Try Again !!');
            }
        }
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
        return view('frontend.pages.non-discrimination',[
            'js' => 'frontend.pages.js.non-discrimination-js'
        ]);

    }

    /**
     * privacy-policy page - privacy-policy us page of the system
     */
    public function privacyPolicy(){
        return view('frontend.pages.privacy-policy',[
            'js' => 'frontend.pages.js.privacy-policy-js'
        ]);
    }

    public function howItWorks(){
        return view('frontend.pages.how-it-works',[
            'js' => 'frontend.pages.js.how-it-works-js'
        ]);
    }

    public function verifyUser(Request $request){
        $linkCheck = VerifyUsers::where('link', $request->link)->first();
        if(!empty($linkCheck)){
            $date = date('Y-m-d');
            $date1 = strtotime($linkCheck->created_at);
            $date2 = strtotime($date);
            $timediff = $date2 - $date1;
            if($timediff > 86400){
                return redirect()
                    ->to('/login')
                    ->with('error','This Verification link has been expired !!');
            }else{
                $check = User::where('email',$linkCheck->email)->first();
                $check->status = 'verified';
                $check->save();
                $linkCheck->delete();
                return redirect()
                    ->to('/login')
                    ->with('success','Your Account Verified Successfully !!');
            }
        }else{
            return redirect()
                ->to('/login')
                ->with('error','This Verification link has been expired !!');
        }

    }
    /**
     * Admin Login - login function for admin area
     */
    public function login(Request $request){
        return view('admin.pages.login',[
            'slug' => 'admin'
        ]);
    }

    /**
     * Read Notification - post function for reading notifications
    */
    public function readNotification(Request $request){
        if($request->isMethod('post')){
            $not = Notifications::find($request->id);
            $not->status = 'read';
            if($not->save()){
                return json_encode([
                    'stat' => 'true'
                ]);
            }else{
                return json_encode([
                    'stat' => 'false'
                ]);
            }
        }
    }


    public function ridemateProfile(Request $request){
        if(!isset($request->email)){
            abort(404);
        }
        $user = User::where('email', $request->email)
            ->where('role', 'driver')
            ->first();
        if(empty($user)){
            abort(404);
        }
        $usd = User_data::where('user_id', $user->id)->first();
        $vd = VehiclesData::where('user_id', $user->id)
            ->first();
        $ratings = Ratings::where('to', $user->id)->get();
        foreach ($ratings as $rat){
            $cus = User::find($rat->from);
            $img = User_data::where('user_id',$rat->from)->first();
            $rat->name = $cus->name;
            $rat->img = $img->picture;
        }

        return view('frontend.pages.ridemate-profile',[
            'usd' => $usd,
            'user' => $user,
            'vd'=> $vd,
            'ratings' => $ratings
        ]);
    }
}
