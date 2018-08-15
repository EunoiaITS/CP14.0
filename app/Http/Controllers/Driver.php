<?php

namespace App\Http\Controllers;

use App\Ride_request;
use App\RideBookings;
use App\User_data;
use App\User;
use App\DriverData;
use App\RideOffers;
use App\RideDescriptions;
use App\VehiclesData;
use App\RideComp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Driver extends Controller
{

    /**
     * Constructor - Applies two middleware Auth and Driver on this Controller
    */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('Driver');
    }
    /**
     * ViewProfile - shows the driver profile info
     */
    public function viewProfile(){
        if(Auth::user()){
            $id = Auth::id();
            $user = User::find($id);
            $usd = User_data::where('user_id',$id)->first();
            if($user->role != 'driver'){
                return redirect()->back();
            }
            return view('frontend.pages.driver-profile',[
                'usd' => $usd,
                'user' => $user,
                'js' => 'frontend.pages.js.driver-profile-js'
            ]);
        }
    }

    /**
     * EditProfile - Profile edit functionality for driver
     * params - $request, takes post/get method data and changes them on database
    */
    public function editProfile(Request $request,$id){
        $user = User::find($id);
        $usd = User_data::where('user_id',$id)->first();
        $dd = DriverData::where('user_id',$id)->first();
        $vd = VehiclesData::where('user_id',$id)->first();
        if($request->isMethod('post')){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $usd->dob = $request->year.'-'.$request->month.'-'.$request->day;
            $usd->gender = $request->gender;
            $usd->address = $request->address;
            $usd->id_card = $request->id_card;
            $usd->contact = $request->contact;
            $usd->save();
            $dd->car_reg = $request->car_reg;
            $dd->driving_license = $request->driving_license;
            $dd->expiry = $request->expiry;
            $dd->save();
            $vd->car_type = $request->car_type;
            $vd->car_plate_no = $request->car_plate_no;
            $vd->luggage_limit = $request->luggage_limit;
            $vd->save();
            return redirect()
                ->to('/d/profile/')
                ->with('success', 'Your Profile Updated Successfully!!');
        }
        return view('frontend.pages.driver-profile-edit',[
            'user' => $user,
            'usd' => $usd,
            'dd' => $dd,
            'vd' => $vd
        ]);
    }


    /**
     * ImageUpload - function for uploading driver's profile picture
     * params - $request takes post method data and processes accordingly
    */
    public function imageUpload(Request $request,$id){
        $usd = User_data::where('user_id',$id)->first();
        if($request->isMethod('post')){
            if($request->hasFile('picture')) {
                $image = $request->file('picture');
                $name = str_slug($id).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/drivers');
                $imagePath = $destinationPath. "/".  $name;
                $image->move($destinationPath, $name);
                $usd->picture = $name;
                $usd->save();
                return redirect()
                    ->to('/d/profile/')
                    ->with('success', 'Your Profile Picture Updated Successfully !!');
            }
        }
    }


    /**
     * EditPassword - function for editing driver account password
     * params - $request takes post/get request data and processes accordingly
    */
    public function editPassword(Request $request, $id){
        $user = User::find($id);
        if($request->isMethod('post')){
            if(Hash::check($request->oldpass, $user->password ) == false){
                return redirect()
                    ->to('d/profile/edit/12')
                    ->with('error','Password Did not matched !!');
            }
            elseif ($request->newpass != $request->repass){
                return redirect()
                    ->to('d/profile/edit/'.$id)
                    ->with('error','Wrong password entered');
            }
            elseif(strlen($request->newpass) < 6 ){
                return redirect()
                    ->to('d/profile/edit/'.$id)
                    ->with('error','Password Must be 6 characters or greater !');
            }
            else{
                $user->password = bcrypt($request->newpass);
                $user->save();
                return redirect()
                    ->to('d/profile/edit/'.$id)
                    ->with('success','Password Changed Successfully !');
            }
        }
    }

    /**
     * OfferRide - shows the offer ride page for drivers
     * takes post request with offer data and creates the offer
     * param - takes post and get request data as object
    */
    public function offerRide(Request $request){
        $req_details = $ex_offer = '';
        $req_id = 0;
        if(isset($request->req) && $request->req != null){
            $req_id = $request->req;
        }
        if($req_id != 0){
            $req_details = Ride_request::find($req_id);
            $time_check = RideOffers::where(['offer_by' => Auth::id()])
                ->where('departure_time', '<=', $req_details->departure_date)
                ->where('arrival_time', '>=', $req_details->departure_date)
                ->first();
            if(!empty($time_check)){
                return redirect('/d/offer-ride')
                    ->with('error', 'You already have existing ride during the requested time!');
            }
            $ex_offer = RideOffers::where(['request_id' => $req_id])->first();
            if(!empty($ex_offer)){
                return redirect('/d/offer-ride')
                    ->with('error', 'Offer already created!!');
            }
        }
        $vd = VehiclesData::where(['user_id' => Auth::id()])->first();
        if($request->isMethod('post')){
            $ride_offer = new RideOffers();
            $vehicles_data = new VehiclesData();
            $errors = array();
            $page_link = '';

            $ro_valid['origin'] = $request->origin;
            $ro_valid['destination'] = $request->destination;
            $ro_valid['price_per_seat'] = $request->price_per_seat;
            $ro_valid['total_seats'] = $request->total_seats;
            $ro_valid['departure_time'] = date('Y-m-d H:i', strtotime($request->d_date .' '. $request->d_hour.':'.$request->d_minute));
            $ro_valid['arrival_time'] = date('Y-m-d H:i', strtotime($request->a_date .' '. $request->a_hour.':'.$request->a_minute));

            if($ro_valid['departure_time'] >= $ro_valid['arrival_time']){
                $errors[] = 'Arrival time has to be greater than the departure time!';
            }
            if(!$ride_offer->validate($ro_valid)){
                $ride_e = $ride_offer->errors();
                foreach ($ride_e->messages() as $k => $v){
                    foreach ($v as $e){
                        $errors[] = $e;
                    }
                }
            }

            $vd_valid['user_id'] = Auth::id();
            $vd_valid['car_plate_no'] = $request->car_plate_no;
            if(!$vehicles_data->validate($vd_valid)){
                $vd_e = $vehicles_data->errors();
                foreach ($vd_e->messages() as $k => $v){
                    foreach ($v as $e){
                        $errors[] = $e;
                    }
                }
            }

            if($request->req_id != ''){
                $ride_offer->request_id = $request->req_id;
                $page_link = '?req='.$request->req_id;
                $time_check = RideOffers::where(['offer_by' => Auth::id()])
                    ->whereDate('departure_time', '<=', $ro_valid['departure_time'])
                    ->whereDate('arrival_time', '>=', $ro_valid['departure_time'])
                    ->first();
                if(!empty($time_check)){
                    $errors[] = 'You already have existing ride during the requested time!';
                }
                $ex_offer = RideOffers::where(['request_id' => $request->req_id])->first();
                if(!empty($ex_offer)){
                    return redirect('/d/offer-ride')
                        ->with('error', 'Offer already created!!');
                }
            }else{
                $ride_offer->request_id = 0;
            }

            if(empty($errors)){
                $ride_offer->offer_by = Auth::id();
                $ride_offer->origin = $request->origin;
                $ride_offer->destination = $request->destination;
                $ride_offer->price_per_seat = $request->price_per_seat;
                $ride_offer->total_seats = $request->total_seats;
                $ride_offer->departure_time = $ro_valid['departure_time'];
                $ride_offer->arrival_time = $ro_valid['arrival_time'];
                $ride_offer->link = $this->generateRandomString();
                $ride_offer->status = 'active';
                $ride_offer->save();
                $ride_offer_id = $ride_offer->id;
                if($request->vd_action == 'add'){
                    $vehicles_data->user_id = Auth::id();
                    $vehicles_data->car_type = $request->car_type;
                    $vehicles_data->car_plate_no = $request->car_plate_no;
                    $vehicles_data->luggage_limit = $request->luggage_limit;
                    $vehicles_data->save();
                    $ride_desc = new RideDescriptions();
                    $ride_desc->ride_offer_id = $ride_offer_id;
                    $ride_desc->key = 'vehicle_id';
                    $ride_desc->value = $vehicles_data->id;
                    $ride_desc->save();
                }else{
                    $vd_data = VehiclesData::find($request->vd_id);
                    $vd_data->car_type = $request->car_type;
                    $vd_data->luggage_limit = $request->luggage_limit;
                    $vd_data->save();
                    $ride_desc = new RideDescriptions();
                    $ride_desc->ride_offer_id = $ride_offer_id;
                    $ride_desc->key = 'vehicle_id';
                    $ride_desc->value = $request->vd_id;
                    $ride_desc->save();
                }
                if($request->pets != ''){
                    $ride_desc = new RideDescriptions();
                    $ride_desc->ride_offer_id = $ride_offer_id;
                    $ride_desc->key = 'pets';
                    $ride_desc->value = $request->pets;
                    $ride_desc->save();
                }
                if($request->music != ''){
                    $ride_desc = new RideDescriptions();
                    $ride_desc->ride_offer_id = $ride_offer_id;
                    $ride_desc->key = 'music';
                    $ride_desc->value = $request->music;
                    $ride_desc->save();
                }
                if($request->smoking != ''){
                    $ride_desc = new RideDescriptions();
                    $ride_desc->ride_offer_id = $ride_offer_id;
                    $ride_desc->key = 'smoking';
                    $ride_desc->value = $request->smoking;
                    $ride_desc->save();
                }
                if($request->back_seat != ''){
                    $ride_desc = new RideDescriptions();
                    $ride_desc->ride_offer_id = $ride_offer_id;
                    $ride_desc->key = 'back_seat';
                    $ride_desc->value = $request->back_seat;
                    $ride_desc->save();
                }

                if($request->total != ''){
                    for($i = 1; $i <= $request->total; $i++){
                        $ride_desc = new RideDescriptions();
                        $ride_desc->ride_offer_id = $ride_offer_id;
                        $ride_desc->key = $request->{'key-'.$i};
                        $ride_desc->value = $request->{'value-'.$i};
                        $ride_desc->save();
                    }
                }

                if($request->req_id != ''){
                    $ride_book = new RideBookings();
                    $ride_book->user_id = $request->req_user_id;
                    $ride_book->ride_id = $ride_offer_id;
                    $ride_book->seat_booked = $request->seat_booked;
                    $ride_book->status = 'booked';
                    $ride_book->save();
                }

                return redirect()
                    ->to('d/active-offers')
                    ->with('success', 'Ride Created Successfully !!');
            }else{
                return redirect()
                    ->to('/d/offer-ride'.$page_link)
                    ->with('errors', $errors)
                    ->withInput();
            }


        }
        return view('frontend.pages.offer-ride', [
            'data' => $req_details,
            'vd' => $vd,
            'req_id' => $req_id,
            'js' => 'frontend.pages.js.offer-ride-js'
        ]);
    }

    /**
     * MyOffers - shows all the active offers created by a driver
    */
    public function myOffers(Request $request){
        $offers = RideOffers::where(['offer_by' => Auth::id()])
            ->whereDate('departure_time', '>=', date('Y-m-d'))
            ->where(function($q){
                $q->where(['status' => 'active'])
                    ->orWhere(['status' => 'in-progress']);
            })
            ->orderBy('departure_time', 'asc')
            ->get();
        foreach($offers as $of){
            $bookings = RideBookings::where(['ride_id' => $of->id])
                ->where(function($q){
                    $q->where(['status' => 'booked'])
                        ->orWhere(['status' => 'confirmed']);
                })
                ->get();
            $of->bookings = $bookings;
        }
        return view('frontend.pages.my-offers', [
            'data' => $offers
        ]);
    }


    /**
     * RideDetails - returns the ride offer details
     * params - takes request and ride link
    */
    public function rideDetails(Request $request, $link){
        $ro = RideOffers::where('link', $link)->first();
        if($ro->status == 'expired' || $ro->status == 'canceled'){
            return redirect()
                ->to('/')
                ->with('error', 'This ride was canceled/expired!');
        }
        $rideStart = RideComp::where(['ride_id' => $ro->id])->first();
        $rd = RideDescriptions::where('ride_offer_id', $ro->id)->get();
        $ro->rd = $rd;
        $vehicle = '';
        foreach($rd as $r){
            if($r->key == 'vehicle_id'){
                $vehicle = $r->value;
            }
        }
        $vd = VehiclesData::find($vehicle);
        $ro->vd = $vd;
        $user = User::find(Auth::id());
        $ro->user = $user;
        $usd = User_data::where('user_id', $ro->offer_by)->first();
        $ro->usd = $usd;
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
            'ride_start' => $rideStart,
            'js' => 'frontend.pages.js.ride-details-js',
            'modals' => 'frontend.pages.modals.ride-details-modals'
        ]);
    }

    /**
     * ConfirmBookings - function for accepting customer bookings
     * param - $request only takes post request data
    */
    public function confirmBookings(Request $request){
        if($request->isMethod('post')){
            $booking = RideBookings::find($request->book_id);
            if($booking->status == 'confirmed'){
                return redirect('/d/ride-details/'.$request->link)
                    ->with('error', 'Booking was already confirmed!');
            }
            $offer = RideOffers::find($booking->ride_id);
            $check = RideBookings::where(['ride_id' => $booking->ride_id])
                ->where(['status' => 'confirmed'])
                ->get();
            if(count($check) >= $offer->total_seats){
                return redirect('/d/ride-details/'.$request->link)
                    ->with('error', 'All seats are confirmed! Can\'t add anymore!');
            }
            $booking->status = 'confirmed';
            $booking->save();
            return redirect('/d/ride-details/'.$request->link)
                ->with('success', 'The ride booking was confirmed!');
        }else{
            return redirect('/')
                ->with('error', 'Wrong request type! Method not allowed!');
        }
    }

    /**
     * CancelBookings - function for rejecting customer bookings
     * param - $request only takes post request data
     */
    public function cancelBookings(Request $request){
        if($request->isMethod('post')){
            $booking = RideBookings::find($request->book_id);
            if($booking->status == 'rejected'){
                return redirect('/d/ride-details/'.$request->link)
                    ->with('error', 'Booking was already rejected!');
            }
            $booking->status = 'rejected';
            $booking->save();
            return redirect('/d/ride-details/'.$request->link)
                ->with('success', 'The ride booking was rejected!');
        }else{
            return redirect('/d/ride-details/'.$request->link)
                ->with('error', 'Wrong request type! Method not allowed!');
        }
    }

    /**
     * rideComp - Function for tracking down the whole ride from start to end
    */
    public function startRide(Request $request){
        if($request->isMethod('post')){
            //dd($request->all());
            $start = new RideComp();
            $errors = array();
            if(!$start->validate($request->all())){
                $ride_e = $start->errors();
                foreach ($ride_e->messages() as $k => $v){
                    foreach ($v as $e){
                        $errors[] = $e;
                    }
                }
            }
            if(empty($errors)){
                $start->ride_id = $request->ride_id;
                $start->start_time = $request->start_time;
                if($start->save()){
                    $offer = RideOffers::find($request->ride_id);
                    $offer->status = 'in-progress';
                    $offer->save();
                    return redirect()
                        ->to($request->ride_url)
                        ->with('success', 'Your ride was started successfully!');
                }else{
                    return redirect()
                        ->to($request->ride_url)
                        ->with('error', 'Your ride couldn\'t started! Please try again!');
                }
            }else{
                return redirect()
                    ->to($request->ride_url)
                    ->with('errors', $errors);
            }
        }
    }

    /**
     * endRide - Function for ending a ride
     */
    public function endRide(Request $request){
        if($request->isMethod('post')){
            $end = RideComp::find($request->ride_id);
            $end->end_time = $request->end_time;
            $ride_det = RideOffers::find($end->ride_id);
            $ride_book = RideBookings::where(['ride_id' => $end->ride_id])
                ->where(['status' => 'confirmed'])
                ->count();
            $end->total_fair = $ride_book * $ride_det->price_per_seat;
            if($end->save()){
                $ride_det->status = 'completed';
                $ride_det->save();
                return redirect()
                    ->to($request->ride_url)
                    ->with('success', 'Your ride was ended successfully!');
            }
            else{
                return redirect()
                    ->to($request->ride_url)
                    ->with('error', 'Your ride couln\'t ended! Please try again!');
            }
        }
    }


    /**
     * generateRandomString - generates random string with alphanumeric characters
     * param - $length is the length of the desired string. 16 by default
    */
    function generateRandomString($length = 16)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    /**
     * EditRide - function to edit an ride from driver's end
     * params - $request accepts get/post request data
     * param - $link accepts the database link field for a particular ride
    */
    public function editRide(Request $request, $link){
        $ro = RideOffers::where(['link' => $link])->first();
        if(Auth::id() != $ro->offer_by){
            return redirect()
                ->to('/d/ride-details/'.$link)
                ->with('error', 'You don\'t have authorization to access this page!');
        }
        $rd = RideDescriptions::where('ride_offer_id', $ro->id)->get();
        $ro->rd = $rd;
        $vehicle = '';
        foreach($rd as $r){
            if($r->key == 'vehicle_id'){
                $vehicle = $r->value;
            }
        }
        $vd = VehiclesData::find($vehicle);
        $ro->vd = $vd;
        $user = User::find(Auth::id());
        $ro->user = $user;
        $usd = User_data::where('user_id', $ro->offer_by)->first();
        $ro->usd = $usd;
        $bookings = RideBookings::where(['ride_id' => $ro->id])
            ->where(function($q){
                $q->where(['status' => 'booked'])
                    ->orWhere(['status' => 'confirmed']);
            })
            ->get();
        $ro->bookings = $bookings;

        if($request->isMethod('post')){
            $ro_edit = RideOffers::find($request->ride_id);
            $ro_edit->origin = $request->origin;
            $ro_edit->destination = $request->destination;
            $ro_edit->price_per_seat = $request->price_per_seat;
            $ro_edit->total_seats = $request->total_seats;
            $ro_edit->departure_time = date('Y-m-d H:i', strtotime($request->d_date .' '. $request->d_hour.':'.$request->d_minute));
            $ro_edit->arrival_time = date('Y-m-d H:i', strtotime($request->a_date .' '. $request->a_hour.':'.$request->a_minute));
            if($ro_edit->departure_time >= $ro_edit->arrival_time){
                return redirect()
                    ->to('/d/edit-ride/'.$ro_edit->link)
                    ->with('error', 'Arrival time should be greater than the departure time!');
            }
            $ride_check = RideOffers::where(['offer_by' => Auth::id()])
                ->where('id', '!=', $request->ride_id)
                ->where('departure_time', '>=', $ro_edit->departure_time)
                ->where('departure_time', '<=', $ro_edit->arrival_time)
                ->first();
            if(!empty($ride_check)){
                return redirect()
                    ->to('/d/edit-ride/'.$ro_edit->link)
                    ->with('error', 'You already have existing ride during the requested time!');
            }
            $ro_edit->save();
            $ride_offer_id = $ro->id;
            if($request->vd_action == 'add'){
                $vehicles_data = new VehiclesData();
                $vehicles_data->user_id = Auth::id();
                $vehicles_data->car_type = $request->car_type;
                $vehicles_data->car_plate_no = $request->car_plate_no;
                $vehicles_data->luggage_limit = $request->luggage_limit;
                $vehicles_data->save();
                $ride_desc = RideDescriptions::where(['ride_offer_id' => $ride_offer_id])
                    ->where(['key' => 'vehicle_id'])
                    ->first();
                $ride_desc->value = $vehicles_data->id;
                $ride_desc->save();
            }else{
                $vd_data = VehiclesData::find($request->vd_id);
                $vd_data->car_type = $request->car_type;
                $vd_data->luggage_limit = $request->luggage_limit;
                $vd_data->save();
            }
            if($request->pets != ''){
                $ride_desc = RideDescriptions::where(['ride_offer_id' => $ride_offer_id])
                    ->where(['key' => 'pets'])
                    ->first();
                $ride_desc->value = $request->pets;
                $ride_desc->save();
            }
            if($request->music != ''){
                $ride_desc = RideDescriptions::where(['ride_offer_id' => $ride_offer_id])
                    ->where(['key' => 'music'])
                    ->first();
                $ride_desc->value = $request->music;
                $ride_desc->save();
            }
            if($request->smoking != ''){
                $ride_desc = RideDescriptions::where(['ride_offer_id' => $ride_offer_id])
                    ->where(['key' => 'smoking'])
                    ->first();
                $ride_desc->value = $request->smoking;
                $ride_desc->save();
            }
            if($request->back_seat != ''){
                $ride_desc = RideDescriptions::where(['ride_offer_id' => $ride_offer_id])
                    ->where(['key' => 'back_seat'])
                    ->first();
                $ride_desc->value = $request->back_seat;
                $ride_desc->save();
            }
            if($request->total_edit != 0){
                for($i = 1; $i <= $request->total_edit; $i++){
                    $ride_desc = RideDescriptions::find($request->{'edit-id-'.$i});
                    $ride_desc->value = $request->{'edit-value-'.$i};
                    $ride_desc->save();
                }
            }

            if($request->total != ''){
                for($i = 1; $i <= $request->total; $i++){
                    $ride_desc = new RideDescriptions();
                    $ride_desc->ride_offer_id = $ride_offer_id;
                    $ride_desc->key = $request->{'key-'.$i};
                    $ride_desc->value = $request->{'value-'.$i};
                    $ride_desc->save();
                }
            }

            return redirect()
                ->to('d/edit-ride/'.$ro->link)
                ->with('success', 'Ride Updated Successfully !!');
        }

        return view('frontend.pages.edit-ride',[
            'data' => $ro,
            'js' => 'frontend.pages.js.edit-ride-js'
        ]);
    }

    /**
     * Ride Request  - shows all the active ride requested by a customer
     */
    public function rideRequests(){
        $rr = Ride_request::where('status','requested')->paginate(3);
        foreach ($rr as $r){
            $user = User::where('id',$r->user_id)->first();
            $r->user = $user;
            $usd = User_data::where('user_id',$r->user_id)->first();
            $r->usd = $usd;
        }
        return view('frontend.pages.ride-requests',[
            'data' => $rr
        ]);
    }
    /**
     * Income Statement  - shows Income Statement of a driver
     * In Basis of Daily,weekly,monthly,yearly
     */
    public function incomeStatement(Request $request){
        if($request->ajax()){
            $id = Auth::id();
            $ro = RideOffers::where('offer_by',$id)->get();
            foreach ($ro as $r){
                $rc = RideComp::where('ride_id',$r->id)->get();
                foreach ($rc as $c){
                    if($request->section == 'daily'){
                        if(date('d',strtotime($c->start_time)) == date('d',strtotime($request->date))){
                            $r->checked = 'yes';
                            $r->start_time = date('Y-m-d',strtotime($c->start_time));
                            $r->time = date('H:i A',strtotime($c->start_time));
                            $r->amount = $c->total_fair;
                        }
                    }elseif ($request->section == 'weekly'){
                        for($i = (date('d',strtotime($request->start_date))+1); $i <= (date('d',strtotime($request->end_date))+1); $i++){
                            if($i == date('d',strtotime($c->start_time))){
                                $r->checked = 'yes';
                                $r->start_time = date('Y-m-d',strtotime($c->start_time));
                                $r->time = date('H:i A',strtotime($c->start_time));
                                $r->amount = $c->total_fair;
                            }
                        }
                    }elseif ($request->section == 'monthly'){
                        if(date('m',strtotime($c->start_time)) == date('m',strtotime($request->date))){
                            $r->checked = 'yes';
                            $r->start_time = date('Y-m-d',strtotime($c->start_time));
                            $r->time = date('H:i A',strtotime($c->start_time));
                            $r->amount = $c->total_fair;
                        }
                    }elseif($request->section == 'yearly'){
                        if(date('Y',strtotime($c->start_time)) == date('Y',strtotime($request->date))){
                            $r->checked = 'yes';
                            $r->start_time = date('Y-m-d',strtotime($c->start_time));
                            $r->time = date('H:i A',strtotime($c->start_time));
                            $r->amount = $c->total_fair;
                        }
                    }
                }
            }
            return json_encode($ro);
        }
    }
}
