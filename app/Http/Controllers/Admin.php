<?php

namespace App\Http\Controllers;

use App\Ride_request;
use App\RideBookings;
use App\RideDescriptions;
use App\RideOffers;
use App\VehiclesData;
use Illuminate\Http\Request;
use App\User;
use App\User_data;
use App\DriverData;
use App\RideComp;
use Carbon\Carbon;

class Admin extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('Admin');
    }

    /**
     * Admin dashboard - overall reviews of the system
    */
    public function dashboard(Request $request){
        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);

        $slug = 'home';
        $driver = User::where('role','driver')->count();
        $customer = User::where('role','customer')->count();
        $today = date('Y-m-d');
        $month = date('m');
        //dd($today);
        $c_daily = User::whereDate('created_at','=', $today)
            ->where('status','verified')
            ->where('role','customer')
            ->count();
        $c_monthly = User::whereMonth('created_at','=', $month)
            ->where('status','verified')
            ->where('role','customer')
            ->count();
        $c_weekly = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('status','verified')
            ->where('role','customer')
            ->count();

        $d_daily = User::whereDate('created_at','=', $today)
            ->where('status','verified')
            ->where('role','driver')
            ->count();

        $d_weekly = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('status','verified')
            ->where('role','driver')
            ->count();

        $d_monthly = User::whereMonth('created_at','=', $month)
            ->where('status','verified')
            ->where('role','driver')
            ->count();

        return view('admin.pages.dashboard', [
            'slug' => $slug,
            'd' => $driver,
            'c' => $customer,
            'c_daily' => $c_daily,
            'c_monthly' => $c_monthly,
            'c_weekly' => $c_weekly,
            'd_daily' => $d_daily,
            'd_weekly' => $d_weekly,
            'd_monthly' => $d_monthly,
            'footer_js' => 'admin.pages.js.dashboard-js'
        ]);
    }

    /**
     * Create Admin function - create admin users for the system
     */
    public function createAdmin(Request $request){
        $data = null;
        $errors = array();
        if($request->isMethod('post')){
            $data = $request->all();
            if($request->password !== $request->repass){
                $errors[] = 'Passwords didn\'t match !!';
            }
            $user = new User();
            if(!$user->validate($data)){
                $user_e = $user->errors();
                foreach ($user_e->messages() as $k => $v){
                    foreach ($v as $e){
                        $errors[] = $e;
                    }
                }
            }
            if(empty($errors)){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->role = 'super-admin';
                $user->save();
                return redirect()
                    ->to('/admin/create-admin')
                    ->with('success', 'The user is created successfully!!');
            }else{
                return redirect()
                    ->to('/admin/create-admin')
                    ->with('errors', $errors)
                    ->withInput();
            }
        }
        $slug = 'addmin';
        return view('admin.pages.create-admins', [
            'slug' => $slug,
            'modals' => 'admin.pages.modals.create-admin-modals',
            'data' => $data
        ]);
    }

    /**
     * Admin List - shows all the admins
     */
    public function adminList(Request $request){
        if($request->isMethod('post')){
            if($request->password !== $request->repass){
                return redirect()
                    ->to('/admin/list')
                    ->with('error', 'Password didn\'t match!! Please try again!!');
            }
            $user = User::find($request->user_id);
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()
                ->to('/admin/list')
                ->with('success', 'User info edited successfully!!');
        }
        $users = User::where('role','super-admin')->get();
        $slug = 'list';
        return view('admin.pages.admin-list', [
            'slug' => $slug,
            'modals' => 'admin.pages.modals.admin-list-modals',
            'users' => $users
        ]);
    }

    /**
     * Delete users - delete function for a particular user
    */
    public function deleteUser(Request $request, $id){
        if($request->isMethod('post')){
            User::destroy($id);
            return redirect()
                ->to('/admin/list')
                ->with('success', 'User deleted successfully!!');
        }else{
            return redirect()
                ->to('/admin/list')
                ->with('error', 'Method not allowed!!');
        }
    }

    /**
     * Driver List - shows all the drivers registered on the system
     */

    public function driverList(Request $request){
        $dr = User::where('role', 'driver')->paginate(20);
        foreach ($dr as $c){
            $usd = User_data::where('user_id', $c->id);
            $c->usd = $usd;
        }
        $slug = 'drivers';
        return view('admin.pages.driver-list', [
            'slug' => $slug,
            'data' => $dr
        ]);
    }


    public function createDriver(Request $request){
        $data = null;
        $errors = array();
        if($request->isMethod('post')){
            $data = $request->all();
            if($request->password !== $request->repass){
                $errors[] = 'Passwords didn\'t match !!';
            }
            $user = new User();
            $usd = new User_data();
            $dd = new DriverData();
            if(!$user->validate($data)){
                $user_e = $user->errors();
                foreach ($user_e->messages() as $k => $v){
                    foreach ($v as $e){
                        $errors[] = $e;
                    }
                }
            }
            if(!$usd->validate($data)){
                $usd_e = $usd->errors();
                foreach ($usd_e->messages() as $k => $v){
                    foreach ($v as $e){
                        $errors[] = $e;
                    }
                }
            }
            if(!$dd->validate($data)){
                $dd_e = $dd->errors();
                foreach ($dd_e->messages() as $k => $v){
                    foreach ($v as $e){
                        $errors[] = $e;
                    }
                }
            }
            if(empty($errors)){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->role = 'driver';
                $user->save();
                $last_id = User::orderBy('id', 'desc')->first();;
                $usd->user_id = $last_id->id;
                $usd->last_name = $request->last_name;
                $usd->dob = $request->dob;
                $usd->gender = $request->gender;
                $usd->address = $request->address;
                $usd->picture = $request->picture;
                $usd->id_card = $request->id_card;
                $usd->status = $request->status;
                $usd->save();
                $dd->user_id = $last_id->id;
                $dd->car_reg = $request->car_reg;
                $dd->driving_license = $request->driving_license;
                $dd->expiry = $request->expiry;
                $dd->uploads = $request->uploads;
                $dd->save();
                return redirect()
                    ->to('/admin/create-driver')
                    ->with('success', 'The Driver is created successfully!!');
            }else{
                return redirect()
                    ->to('/admin/create-driver')
                    ->with('errors',$errors)
                    ->withInput();
            }
        }
        $slug = 'driver';
        return view('admin.pages.create-drivers', [
            'slug' => $slug,
            'modals' => 'admin.pages.modals.create-admin-modals',
            'data' => $data
        ]);
    }

    /**
     * Customer List - shows all the customers connected with the system
     */

    public function customerList(Request $request){
        $cus = User::where('role', 'customer')->paginate(20);
        foreach ($cus as $c){
            $usd = User_data::where('user_id', $c->id);
            $c->usd = $usd;
        }
        $slug = 'customers';
        return view('admin.pages.customer-list', [
            'slug' => $slug,
            'data' => $cus
        ]);
    }

    public function createCustomer(Request $request){
        $data = null;
        $errors = array();
        if($request->isMethod('post')){
            $data = $request->all();
            if($request->password !== $request->repass){
                $errors[] = 'Passwords didn\'t match !!';
            }
            $user = new User();
            $usd = new User_data();
            if(!$user->validate($data)){
                $user_e = $user->errors();
                foreach ($user_e->messages() as $k => $v){
                    foreach ($v as $e){
                        $errors[] = $e;
                    }
                }
            }
            if(!$usd->validate($data)){
                $usd_e = $usd->errors();
                foreach ($usd_e->messages() as $k => $v){
                    foreach ($v as $e){
                        $errors[] = $e;
                    }
                }
            }
            if(empty($errors)){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->role = 'customer';
                $user->save();
                $last_id = User::orderBy('id', 'desc')->first();
                $usd->user_id = $last_id->id;
                $usd->last_name = $request->last_name;
                $usd->dob = $request->dob;
                $usd->gender = $request->gender;
                $usd->address = $request->address;
                $usd->picture = $request->picture;
                $usd->id_card = $request->id_card;
                $usd->status = $request->status;
                $usd->save();
                return redirect()
                    ->to('/admin/create-customers')
                    ->with('success', 'The Customer is created successfully!!');
            }else{
                return redirect()
                    ->to('/admin/create-customers')
                    ->with('errors',$errors)
                    ->withInput();
            }
        }
        $slug = 'customer';
        return view('admin.pages.create-customers', [
            'slug' => $slug,
            'modals' => 'admin.pages.modals.create-admin-modals',
            'data' => $data
        ]);
    }

    /**
     * Ride Details - shows all the rides info by the system
     */
    public function rideDetails(Request $request){
        $rides = RideOffers::where('status', 'completed')->paginate(10);
        $reqs = RideOffers::where('status', 'completed')
            ->where('request_id', '!=', 0)
            ->paginate(10);
        if($request->isMethod('post')){
            //dd($request->all());
            if($request->search_mode == 'd'){
                $rides = RideOffers::whereDate('departure_time', '=', date('Y-m-d',strtotime($request->date)))
                    ->where('status', 'completed')
                    ->paginate(10);
            }
            if($request->search_mode == 'w'){
                $rides = RideOffers::whereBetween('departure_time', [date('Y-m-d',strtotime($request->start_date)), date('Y-m-d',strtotime($request->end_date))])
                    ->where('status', 'completed')
                    ->paginate(10);
            }
            if($request->search_mode == 'm'){
                $rides = RideOffers::whereMonth('departure_time', '=', date('m',strtotime($request->date)))
                    ->where('status', 'completed')
                    ->paginate(10);
            }
            if($request->search_mode == 'y'){
                $rides = RideOffers::whereYear('departure_time', '=', date('Y',strtotime($request->date)))
                    ->where('status', 'completed')
                    ->paginate(10);
            }
            if($request->filter == 'req'){
                if($request->search_mode == 'rd'){
                    $reqs = RideOffers::whereDate('departure_time', '=', date('Y-m-d',strtotime($request->date)))
                        ->where('status', 'completed')
                        ->where('request_id', '!=', 0)
                        ->paginate(10);
                }
                if($request->search_mode == 'rw'){
                    $reqs = RideOffers::whereBetween('departure_time', [date('Y-m-d',strtotime($request->start_date)), date('Y-m-d',strtotime($request->end_date))])
                        ->where('status', 'completed')
                        ->where('request_id', '!=', 0)
                        ->paginate(10);
                }
                if($request->search_mode == 'rm'){
                    $reqs = RideOffers::whereMonth('departure_time', '=', date('m',strtotime($request->date)))
                        ->where('status', 'completed')
                        ->where('request_id', '!=', 0)
                        ->paginate(10);
                }
                if($request->search_mode == 'ry'){
                    $reqs = RideOffers::whereYear('departure_time', '=', date('Y',strtotime($request->date)))
                        ->where('status', 'completed')
                        ->where('request_id', '!=', 0)
                        ->paginate(10);
                }
            }
        }
        foreach($rides as $ride){
            $ride->mate = User::find($ride->offer_by);
            if($ride->req_id != null){
                $ride_req = Ride_request::find($ride->req_id);
                $ride->requester = User::find($ride_req->user_id);
                $ride->ride_req = $ride_req;
            }
        }
        if(!empty($reqs)){
            foreach($reqs as $req){
                $req->mate = User::find($req->offer_by);
                $ride_req = Ride_request::find($req->request_id);
                $req->requester = User::find($ride_req->user_id);
                $req->ride_req = $ride_req;
            }
        }
        $slug = 'rides';
        return view('admin.pages.ride-details', [
            'data' => $rides,
            'reqs' => $reqs,
            'slug' => $slug,
            'footer_js' => 'admin.pages.js.ride-details-js'
        ]);
    }

    /**
     * View Customer - shows the detailed info of a customer on the system
     */
    public function viewCustomer(Request $request){
        $slug = '';
        $id = $request->route('id');
        $user = User::find($id);
        $user_details = User_data::where('user_id', $id)->first();
        $bookings = RideBookings::where('user_id', $id)
            ->where('status', 'confirmed')
            ->get();

        foreach($bookings as $book){
            $details = RideOffers::where('id', $book->ride_id)
                ->where('status', 'completed')
                ->first();
            if($details != null){
                $details->ridemate = User::find($details->offer_by);
                $vehicle_id = RideDescriptions::where('ride_offer_id', $details->id)
                    ->where('key', 'vehicle_id')
                    ->first();
                $details->vehicle = VehiclesData::find($vehicle_id->value);
                $book->details = $details;
            }
        }

        return view('admin.pages.view-customer', [
            'slug' => $slug,
            'books' => $bookings,
            'data' => $user,
            'details' => $user_details,
            'modals' => 'admin.pages.modals.view-customer-modals'
        ]);
    }

    /**
     * View Driver - shows the detailed info of a driver on the system
     */
    public function viewDriver(Request $request){
        $slug = '';
        $id = $request->route('id');
        $user = User::find($id);
        $user_details = User_data::where('user_id', $id)->first();
        $dd = DriverData::where('user_id', $id)->first();

        $rides = RideOffers::where('offer_by', $id)
            ->where('status', 'completed')
            ->paginate(10);
        foreach($rides as $ride){
            $books = RideBookings::where('ride_id', $ride->id)
                ->where('status', 'confirmed')
                ->get();
            foreach($books as $book){
                $book->rider = User::find($book->user_id);
            }
            $ride->books = $books;
            $v_id = RideDescriptions::where('ride_offer_id', $ride->id)
                ->where('key', 'vehicle_id')
                ->first();
            $ride->vehicle = VehiclesData::find($v_id->value);
        }

        return view('admin.pages.view-driver', [
            'slug' => $slug,
            'data' => $user,
            'rides' => $rides,
            'details' => $user_details,
            'dd' => $dd,
            'footer_js' => 'admin.pages.js.view-driver-js',
            'modals' => 'admin.pages.modals.view-driver-modals'
        ]);
    }

    public function incomeStatement(Request $request){
            $id = $request->id;
            $ro = RideOffers::where('offer_by',$id)
                ->where('status','completed')
                ->get();
            foreach ($ro as $r){
                $rc = RideComp::where('ride_id',$r->id)->first();
                    if($request->section == 'daily'){
                        if(date('d',strtotime($rc->start_time)) == date('d',strtotime($request->date))){
                            $r->checked = 'yes';
                            $r->start_time = date('Y-m-d',strtotime($rc->start_time));
                            $r->time = date('H:i A',strtotime($rc->start_time));
                            $r->amount = $rc->total_fair;
                        }
                    }
                    if ($request->section == 'weekly'){
                        for($i = (date('d',strtotime($request->start_date))+1); $i <= (date('d',strtotime($request->end_date))+1); $i++){
                            if($i == date('d',strtotime($rc->start_time))){
                                $r->checked = 'yes';
                                $r->start_time = date('Y-m-d',strtotime($rc->start_time));
                                $r->time = date('H:i A',strtotime($rc->start_time));
                                $r->amount = $rc->total_fair;
                            }
                        }
                    }
                    if ($request->section == 'monthly'){
                        if(date('m',strtotime($rc->start_time)) == date('m',strtotime($request->date))){
                            $r->checked = 'yes';
                            $r->start_time = date('Y-m-d',strtotime($rc->start_time));
                            $r->time = date('H:i A',strtotime($rc->start_time));
                            $r->amount = $rc->total_fair;
                        }
                    }
                    if($request->section == 'yearly'){
                        if(date('Y',strtotime($rc->start_time)) == date('Y',strtotime($request->date))){
                            $r->checked = 'yes';
                            $r->start_time = date('Y-m-d',strtotime($rc->start_time));
                            $r->time = date('H:i A',strtotime($rc->start_time));
                            $r->amount = $rc->total_fair;
                        }
                    }
            }
            return json_encode($ro);
        }
    public function totalIncome(Request $request){
        $ro = RideOffers::where('status','completed')
            ->get();
        foreach ($ro as $r){
            $rc = RideComp::where('ride_id',$r->id)->first();
            if($request->section == 'daily'){
                if(date('d',strtotime($rc->start_time)) == date('d',strtotime($request->date))){
                    $r->checked = 'yes';
                    $r->ride_no = $r->id;
                    $r->start_time = date('Y-m-d',strtotime($rc->start_time));
                    $r->time = date('H:i A',strtotime($rc->start_time));
                    $r->amount = $rc->total_fair;
                }
            }
            if ($request->section == 'weekly'){
                for($i = (date('d',strtotime($request->start_date))+1); $i <= (date('d',strtotime($request->end_date))+1); $i++){
                    if($i == date('d',strtotime($rc->start_time))){
                        $r->checked = 'yes';
                        $r->ride_no = $r->id;
                        $r->start_time = date('Y-m-d',strtotime($rc->start_time));
                        $r->time = date('H:i A',strtotime($rc->start_time));
                        $r->amount = $rc->total_fair;
                    }
                }
            }
            if ($request->section == 'monthly'){
                if(date('m',strtotime($rc->start_time)) == date('m',strtotime($request->date))){
                    $r->checked = 'yes';
                    $r->ride_no = $r->id;
                    $r->start_time = date('Y-m-d',strtotime($rc->start_time));
                    $r->time = date('H:i A',strtotime($rc->start_time));
                    $r->amount = $rc->total_fair;
                }
            }
            if($request->section == 'yearly'){
                if(date('Y',strtotime($rc->start_time)) == date('Y',strtotime($request->date))){
                    $r->checked = 'yes';
                    $r->ride_no = $r->id;
                    $r->start_time = date('Y-m-d',strtotime($rc->start_time));
                    $r->time = date('H:i A',strtotime($rc->start_time));
                    $r->amount = $rc->total_fair;
                }
            }
        }
        return json_encode($ro);
    }
    public function block(Request $request){
        $user = User::find($request->user_id);
        $user->status = 'blocked';
        $user->save();
        return redirect()
            ->to('admin/drivers/view/'.$request->user_id);
    }
    public function unblock(Request $request){
        $user = User::find($request->user_id);
        $user->status = 'verified';
        $user->save();
        return redirect()
            ->to('admin/drivers/view/'.$request->user_id);
    }
}
