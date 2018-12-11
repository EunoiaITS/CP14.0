<?php

namespace App\Http\Controllers;

use App\Events\OfferCreated;
use App\Events\RideRequest;
use App\Notifications;
use App\Ratings;
use App\RideBookings;
use DB;
use App\User_data;
use App\User;
use App\Ride_request;
use App\RideOffers;
use App\RideDescriptions;
use App\VehiclesData;
use App\Countries;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Customer extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('Customer');
    }

    public function viewProfile(Request $request){
        $id = Auth::id();
        $user = User::find($id);
        if($user->role != 'customer'){
            return redirect()
                ->to('/')
                ->with('error', 'You don\'t have access to this page!');
        }
        $usd = User_data::where('user_id', $id)->first();
        $bookings = new Collection();
        $booking = RideBookings::where('user_id', $id)
            ->where(function($q){
                $q->where(['status' => 'booked'])
                    ->orWhere(['status' => 'confirmed']);
            })
            ->get();

        foreach($booking as $book){
            $ride_details = RideOffers::find($book->ride_id);
            if(!empty($ride_details)){
                $book->ride_details = $ride_details;
                $by = User::find($ride_details->offer_by);
                $book->user = $by;
                $ud = User_data::where(['user_id' => $user->id])->first();
                $book->ud = $ud;
                $ride_desc = RideDescriptions::where(['ride_offer_id' => $book->ride_id])
                    ->where(['key' => 'vehicle_id'])
                    ->first();
                $vd = VehiclesData::find($ride_desc->value);
                $book->vd = $vd;
                $bookings->push($book);
            }
        }
        if($request->isMethod('post')){
            $usr = User::find($request->cus_id);
            $usr->status = 'blocked';
            if($usr->save()){
                return redirect()
                    ->to('/login')
                    ->with(Auth::logout())
                    ->with('error','This account has been deactivated. To activate the account again please contact with the admin.');
            }
        }

        return view('frontend.pages.customer-profile',[
            'usd' => $usd,
            'user' => $user,
            'data' => $bookings,
            'modals' => 'frontend.pages.modals.customer-profile-modals',
        ]);
    }

    public function editProfile(Request $request){
        $user = User::find(Auth::id());
        $usd = User_data::where('user_id', Auth::id())->first();
        $countries = Countries::orderBy('name','asc')->get();
            if($request->isMethod('post')) {
                $user->name = $request->name;
                $user->save();
                $usd->last_name = $request->last_name;
                $usd->dob = $request->year.'-'.$request->month.'-'.$request->day;
                $usd->gender = $request->gender;
                $usd->address = $request->address;
                $usd->id_card = $request->id_card;
                $usd->contact = $request->contact;
                $usd->country_code = $request->country_code;
                $usd->save();
                return redirect()
                    ->to('/c/profile/')
                    ->with('success', 'Your Account Updated Successfully !!');
            }
        return view('frontend.pages.customer-profile-edit', [
                'user' => $user,
                'usd' => $usd,
                'countries' => $countries
            ]);
    }

    public function imageUpload(Request $request){
        $usd = User_data::where('user_id', Auth::id())->first();
        if($request->isMethod('post')){
            if($request->hasFile('picture')) {
                $image = $request->file('picture');
                $name = str_slug(Auth::id()).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/customers');
                $formats = array("JPG","jpg","jpeg","png","gif");
                        if(in_array($image->getClientOriginalExtension(),$formats)){
                            if($image->getSize() > 2097152){
                                return redirect()
                                    ->to('/c/profile/edit/')
                                    ->with('error', 'Your Profile Picture Size Exceed Limit of 2Mb !!');
                            }else{
                        $imagePath = $destinationPath. "/".  $name;
                        $image->move($destinationPath, $name);
                        $usd->picture = $name;
                        $usd->save();
                        return redirect()
                            ->to('/c/profile/edit/')
                            ->with('success', 'Your Profile Picture Updated Successfully !!');
                    }
                }else{
                    return redirect()
                        ->to('/c/profile/edit/')
                        ->with('error', 'Your Profile Picture Format Not Supported !!');
                }
            }
        }
    }

    /**
     * editPassword - function to edit the password
    */
    public function editPassword(Request $request){
        $user = User::find(Auth::id());
        if($request->isMethod('post')){
            if(Hash::check($request->oldpass,$user->password ) == false){
                return redirect()
                    ->to('c/profile/edit')
                    ->with('error','Password Did not matched !!');
            }
            elseif ($request->newpass != $request->repass){
                return redirect()
                    ->to('c/profile/edit')
                    ->with('error','Wrong password entered');
            }
            elseif(strlen($request->newpass) < 6 ){
                return redirect()
                    ->to('c/profile/edit')
                    ->with('error','Password Must be 6 characters or greater !');
            }
            else{
                $user->password = bcrypt($request->newpass);
                $user->save();
                return redirect()
                    ->to('c/profile/edit')
                    ->with('success','Password Changed Successfully !');
            }
        }
    }

    /**
     * Bookings - shows the customer ride bookings
    */
    public function bookings(Request $request){
        $bookings = new Collection();
        $booking = RideBookings::where(['user_id' => Auth::id()])
            ->where(function($q){
                $q->where(['status' => 'booked'])
                    ->orWhere(['status' => 'confirmed']);
            })
            ->get();
        foreach($booking as $book){
            $ride_details = RideOffers::find($book->ride_id);
            if(!empty($ride_details)){
                $book->ride_details = $ride_details;
                $user = User::find($ride_details->offer_by);
                $book->user = $user;
                $ud = User_data::where(['user_id' => $user->id])->first();
                $book->ud = $ud;
                $ride_desc = RideDescriptions::where(['ride_offer_id' => $book->ride_id])
                    ->where(['key' => 'vehicle_id'])
                    ->first();
                $vd = VehiclesData::find($ride_desc->value);
                $book->vd = $vd;
                $bookings->push($book);
            }
        }
        return view('frontend.pages.bookings', [
            'data' => $bookings,
            'modals' => 'frontend.pages.modals.bookings-modals'
        ]);
    }

    /**
     * bookRide - function to book a ride
    */
    public function bookRide(Request $request){
        if($request->isMethod('post')){
            $ride = RideOffers::find($request->ride_id);
            $bookings = RideBookings::where(['ride_id' => $request->ride_id])
                ->where(function($q){
                    $q->where(['status' => 'booked'])
                        ->orWhere(['status' => 'confirmed']);
                })
                ->get();
            $book_count = 0;
            foreach($bookings as $book){
                $book_count += $book->seat_booked;
            }
            if($request->seat_booked > ($ride->total_seats - $book_count)){
                return redirect()
                    ->to($request->ride_url)
                    ->with('error', 'Your requested seats has exceeded the availability!');
            }
            $errors = array();
            $ride_book = new RideBookings();
            if(!$ride_book->validate($request->all())){
                $rb_e = $ride_book->errors();
                foreach ($rb_e->messages() as $k => $v){
                    foreach ($v as $e){
                        $errors[] = $e;
                    }
                }
            }
            if(empty($errors)){
                for($i = 1; $i <= $request->seat_booked; $i++){
                    $ride_books = new RideBookings();
                    $ride_books->user_id = Auth::id();
                    $ride_books->ride_id = $request->ride_id;
                    $ride_books->seat_booked = 1;
                    $ride_books->status = $request->status;
                    $ride_books->save();
                    event(new OfferCreated([
                        'event' => 'ride-booked',
                        'from' => Auth::id(),
                        'offer_id' => $request->ride_id
                    ]));
                }
                return redirect()
                    ->to($request->ride_url)
                    ->with('success', 'Ride is added, pending acceptance. Check notification bar and
communicate with Ridemates directly !');
            }else{
                return redirect()
                    ->to($request->ride_url)
                    ->with('errors', $errors);
            }
        }
    }

    /**
     * cancelRide - Function for cancelling a ride booking
    */
    public function cancelBooking(Request $request){
        if($request->isMethod('post')){
            $book = RideBookings::find($request->book_id);
            $book->status = 'canceled';
            $book->save();
            return redirect()
                ->to($request->page_url)
                ->with('success', 'Your ride booking was canceled!');
        }
    }

    /**
     * rideDetails - function to show the details of a particular ride
    */
    public function rideDetails(Request $request, $link){
        $ro = RideOffers::where('link', $link)->first();
        if(empty($ro)){
            abort(404);
        }
        if($ro->status == 'expired' || $ro->status == 'canceled'){
            return redirect()
                ->to('/')
                ->with('error', 'This ride was canceled/expired!');
        }
        $rd = RideDescriptions::where('ride_offer_id', $ro->id)->get();
        $ro->rd = $rd;
        $user = User::find($ro->offer_by);
        $ro->user = $user;
        $vehicle = '';
        foreach($rd as $r){
            if($r->key == 'vehicle_id'){
                $vehicle = $r->value;
            }
        }
        $vd = VehiclesData::find($vehicle);
        $ro->vd = $vd;
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
        $rates = $rate_tos = array();
        $ratings = Ratings::where('ride_id', $ro->id)->get();
        foreach($ratings as $rate){
            $rates[] = $rate->from;
            $rate_tos[] = $rate->to;
        }
        return view('frontend.pages.ride-details',[
            'data' => $ro,
            'rates' => $rates,
            'rate_tos' => $rate_tos,
            'js' => 'frontend.pages.js.ride-details-js',
            'modals' => 'frontend.pages.modals.ride-details-modals'
        ]);
    }

    /**
     * rideRequests - show all active ride requests of a customer
    */
    public function rideRequests(Request $request){
        $reqs = Ride_request::where(['user_id' => Auth::id()])
            ->where('departure_date', '>=', date('Y-m-d H:i:s'))
            ->where(['status' => 'requested'])
            ->get();
        foreach($reqs as $req){
            $offer = RideOffers::where(['request_id' => $req->id])
                ->where(['status' => 'active'])
                ->get();
            $req->offer = $offer;
        }
        $ex_reqs = Ride_request::where(['user_id' => Auth::id()])
            ->where(['status' => 'expired'])
            ->get();
        return view('frontend.pages.requests', [
            'data' => $reqs,
            'ex_data' => $ex_reqs,
            'js'=> 'frontend.pages.js.home-js'
        ]);
    }

    /**
     * deleteRequest - functions to delete one or multiple ride requests
    */
    public function deleteRequest(Request $request){
        if($request->isMethod('post')){
            if(empty($request->delete_req)){
                return redirect()
                    ->to('/c/requests')
                    ->with('error', 'Please select requests to delete!');
            }
            foreach($request->delete_req as $del){
                Ride_request::destroy($del);
            }
            return redirect()
                ->to('/c/requests')
                ->with('success', 'Selected requests were deleted!');
        }
    }

    /**
     * rideRequest - function for creating a ride request
    */
    public function rideRequest(Request $request){
        if($request->isMethod('post')){
            //dd($request->all());
            $ex_req = Ride_request::where(['user_id' => Auth::id()])
                ->where(['status' => 'requested'])
                ->get();
            foreach($ex_req as $er){
                if(date('Y-m-d H:i', strtotime($request->departure_date)) == date('Y-m-d H:i', strtotime($er->departure_date))){
                    return redirect()
                        ->to($request->req_url)
                        ->with('error', 'You already have ride request on this requested time!')
                        ->withInput();
                }
                $ex_off = RideOffers::where(['request_id' => $er->id])
                    ->where(['status' => 'active'])
                    ->where('departure_time', '<=', date('Y-m-d H:i:s', strtotime($request->departure_date)))
                    ->where('arrival_time', '>=', date('Y-m-d H:i:s', strtotime($request->departure_date)))
                    ->first();
                if(!empty($ex_off)){
                    return redirect()
                        ->to($request->req_url)
                        ->with('error', 'You already have a ride booking during this requested time!')
                        ->withInput();
                }
            }
            $errors = array();
            $ride_request = new Ride_request();
            if(!$ride_request->validate($request->all())){
                $ride_req_e = $ride_request->errors();
                foreach ($ride_req_e->messages() as $k => $v){
                    foreach ($v as $e){
                        $errors[] = $e;
                    }
                }
            }
            if(empty($errors)){
                $ride_request->user_id = Auth::id();
                $ride_request->from = $request->from;
                $ride_request->to = $request->to;
                $ride_request->departure_date = date('Y-m-d H:i', strtotime($request->departure_date));
                if(isset($request->seat_required)){
                    $ride_request->seat_required = $request->seat_required;
                }else{
                    $ride_request->seat_required = 1;
                }
                $ride_request->status = 'requested';
                if($ride_request->save()){
                    event(new OfferCreated([
                        'event' => 'ride-request',
                        'from' => Auth::id(),
                        'req_id' => $ride_request->id
                    ]));
                    return redirect()
                        ->to($request->req_url)
                        ->with('success', 'The ride request was created successfully!');
                }else{
                    return redirect()
                        ->to($request->req_url)
                        ->with('error', 'The ride request couldn\'t created!')
                        ->withInput();
                }
            }else{
                return redirect()
                    ->to($request->req_url)
                    ->with('errors', $errors)
                    ->withInput();
            }
        }
    }

    /**
     * cancelRequest - function for canceling a ride request
     */
    public function cancelRequest(Request $request){
        if($request->isMethod('post')) {
            $ride_request = Ride_request::find($request->req_id);
            $ride_check = RideOffers::where(['request_id' => $request->req_id])
                ->where(['status' => 'active'])
                ->get();
            if(!empty($ride_check)){
                $book_check = RideBookings::where(['ride_id' => $ride_check->id])
                    ->where(['user_id' => $ride_request->user_id])
                    ->where(function($q){
                        $q->where(['status' => 'booked'])
                            ->orWhere(['status' => 'confirmed']);
                    })
                    ->get();
                if(!empty($book_check)){
                    return redirect()
                        ->to($request->page_url)
                        ->with('error', 'You have to cancel the ride booking/confirmation first! Here\'s the ride link '.url('c/ride-details/'.$ride_check->link));
                }
            }
            $ride_request->status = 'canceled';
            if($ride_request->save()){
                return redirect()
                    ->to($request->page_url)
                    ->with('success', 'Your ride request was deleted!');
            }else{
                return redirect()
                    ->to($request->page_url)
                    ->with('error', 'Your ride request couldn\'n deleted! Please try again!');
            }
        }
    }

    /**
     * Notifications - shows all notifications
    */
    public function notifications(){
        $notifications = Notifications::where('to', Auth::id())
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('frontend.pages.notifications', [
            'data' => $notifications,
            'slug' => 'not'
        ]);
    }

    /**
     * Rate - rate a ridemate/driver
    */
    public function rate(Request $request, $link){
        $ride = RideOffers::where('link', $link)
            ->where('status', 'completed')
            ->first();
        if(empty($ride)){
            abort(404);
        }else{
            $check = Ratings::where('ride_id', $ride->id)
                ->where('from', Auth::id())
                ->first();
            if(!empty($check)){
                abort(404);
            }
            $book_check = RideBookings::where('user_id', Auth::id())
                ->where('ride_id', $ride->id)
                ->where('status', 'confirmed')
                ->first();
            if(empty($book_check)){
                abort(404);
            }
            $ride->driver = User::find($ride->offer_by);
            $ride->driver_data = User_data::where('user_id', $ride->offer_by)->first();
        }
        if($request->isMethod('post')){
            $errors = array();
            $rating = new Ratings();
            if(!$rating->validate($request->all())){
                $rating_e = $rating->errors();
                foreach ($rating_e->messages() as $k => $v){
                    foreach ($v as $e){
                        $errors[] = $e;
                    }
                }
            }
            if(empty($errors)){
                $rating->ride_id = $request->ride_id;
                $rating->from = $request->from;
                $rating->to = $request->to;
                $rating->rating = $request->rating;
                $rating->comment = $request->comment;
                $rating->save();
                return redirect()
                    ->to('/ride-details/'.$ride->link)
                    ->with('success', 'Your rating was successfully added!');
            }else{
                return redirect()
                    ->to('/c/rate/'.$ride->link)
                    ->with('errors', $errors);
            }
        }
        return view('frontend.pages.rate', [
            'data' => $ride,
            'js' => 'frontend.pages.js.rate-js'
        ]);
    }

    public function history(){
        $id = Auth::id();
        $ro = RideOffers::where(['status' => 'completed'])
            ->orderBy('departure_time')
            ->paginate(10);
        foreach ($ro as $r){
            $rb = RideBookings::where('user_id',$id)
                ->where('ride_id',$r->id)->get();
            foreach ($rb as $b){
                $r->seat_booked = $b->seat_booked;
                $r->check = 'yes';
            }
        }

        return view('frontend.pages.history-customer',[
            'data' => $ro
        ]);
    }

}
