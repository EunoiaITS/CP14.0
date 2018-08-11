<?php

namespace App\Http\Controllers;

use App\RideBookings;
use DB;
use App\User_data;
use App\User;
use App\Ride_request;
use App\RideOffers;
use App\RideDescriptions;
use App\VehiclesData;
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

    public function viewProfile(){
        if(Auth::user()){
            $id = Auth::id();
            $user = User::find($id);
            $usd = User_data::where('user_id',$id)->first();
            if($user->role != 'customer'){
                return redirect()->back();
            }
            return view('frontend.pages.customer-profile',[
                'usd' => $usd,
                'user' => $user
            ]);
        }
    }

    public function editProfile(Request $request,$id){
        $user = User::find($id);
        $usd = User_data::where('user_id',$id)->first();
            if($request->isMethod('post')) {
                $user->name = $request->name;
                $user->save();
                $usd->last_name = $request->last_name;
                $usd->dob = $request->year.'-'.$request->month.'-'.$request->day;
                $usd->gender = $request->gender;
                $usd->address = $request->address;
                $usd->id_card = $request->id_card;
                $usd->save();
                return redirect()
                    ->to('/c/profile/')
                    ->with('success', 'Your Account Updated Successfully !!');
            }
        return view('frontend.pages.customer-profile-edit', [
                'user' => $user,
                'usd' => $usd
            ]);
    }

    public function imageUpload(Request $request,$id){
        $usd = User_data::where('user_id',$id)->first();
        if($request->isMethod('post')){
            if($request->hasFile('picture')) {
                $image = $request->file('picture');
                $name = str_slug($id).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/customers');
                $imagePath = $destinationPath. "/".  $name;
                $image->move($destinationPath, $name);
                $usd->picture = $name;
                $usd->save();
                return redirect()
                    ->to('/c/profile/')
                    ->with('success', 'Your Profile Picture Updated Successfully !!');
            }
        }
    }
    public function editPassword(Request $request,$id){
        $user = User::find($id);
        if($request->isMethod('post')){
            if(Hash::check($request->oldpass,$user->password ) == false){
                return redirect()
                    ->to('c/profile/edit/'.$id)
                    ->with('error','Password Did not matched !!');
            }
            elseif ($request->newpass != $request->repass){
                return redirect()
                    ->to('c/profile/edit/'.$id)
                    ->with('error','Wrong password entered');
            }
            elseif(strlen($request->newpass) < 6 ){
                return redirect()
                    ->to('c/profile/edit/'.$id)
                    ->with('error','Password Must be 6 characters or greater !');
            }
            else{
                $user->password = bcrypt($request->newpass);
                $user->save();
                return redirect()
                    ->to('c/profile/edit/'.$id)
                    ->with('success','Password Changed Successfully !');
            }
        }
    }

    /**
     * Bookings - shows the customer ride bookings
    */
    public function bookings(Request $request){
        $bookings = RideBookings::where(['user_id' => Auth::id()])->where(['status' => 'booked'])->get();
        foreach($bookings as $book){
            $ride_details = RideOffers::find($book->ride_id);
            $book->ride_details = $ride_details;
            $ride_desc = RideDescriptions::where(['ride_offer_id' => $book->ride_id])
                ->where(['key' => 'vehicle_id'])
                ->first();
            $vd = VehiclesData::find($ride_desc->value);
            $book->vd = $vd;
        }
        return view('frontend.pages.bookings', [
            'data' => $bookings
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
            $book_count = $request->seat_booked;
            foreach($bookings as $book){
                $book_count += $book->seat_booked;
            }
            if($book_count > $ride->total_seats){
                return redirect()
                    ->to($request->ride_url)
                    ->with('error', 'This ride has reached the maximum bookings!');
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
                $ride_book->user_id = Auth::id();
                $ride_book->ride_id = $request->ride_id;
                $ride_book->seat_booked = $request->seat_booked;
                $ride_book->status = $request->status;
                if($ride_book->save()){
                    return redirect()
                        ->to($request->ride_url)
                        ->with('success', 'The ride booking was added!');
                }else{
                    return redirect()
                        ->to($request->ride_url)
                        ->with('errors', 'The ride booking couldn\'t added! Please try again!');
                }
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
                ->to($request->ride_url)
                ->with('success', 'Your ride booking was canceled!');
        }
    }

    public function rideDetails(Request $request, $link){
        $ro = RideOffers::where('link', $link)->first();
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
        dd($bookings);
        $ro->bookings = $bookings;
        return view('frontend.pages.ride-details',[
            'data' => $ro,
            'js' => 'frontend.pages.js.ride-details-js',
            'modals' => 'frontend.pages.modals.ride-details-modals'
        ]);
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
     * Search - function for searching drivers
     */
    public function rideRequest(Request $request){
        if($request->isMethod('post')){
            $ride_request = new Ride_request();
            $ride_request->user_id = Auth::id();
            $ride_request->from = $request->from;
            $ride_request->to = $request->to;
            $ride_request->departure_date = date('Y-m-d H:i:s', strtotime($request->departure_date));
            if(isset($request->seat_required)){
                $ride_request->seat_required = $request->seat_required;
            }else{
                $ride_request->seat_required = 1;
            }
            if($ride_request->save()){
                return redirect($request->url())
                    ->with('success', 'The ride request was created successfully!');
            }else{
                return redirect($request->url())
                    ->with('error', 'The ride request couldn\'t created!');
            }
        }
            return view('frontend.pages.search');
    }

}
