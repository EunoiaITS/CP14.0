<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_data;
use App\DriverData;

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
        $slug = 'home';
        return view('admin.pages.dashboard', [
            'slug' => $slug
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
        $slug = 'rides';
        return view('admin.pages.ride-details', [
            'slug' => $slug
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

        return view('admin.pages.view-customer', [
            'slug' => $slug,
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

        return view('admin.pages.view-driver', [
            'slug' => $slug,
            'data' => $user,
            'details' => $user_details,
            'dd' => $dd,
            'modals' => 'admin.pages.modals.view-driver-modals'
        ]);
    }

    /**
     * Login - login function for admin area
    */
    public function login(Request $request){
        return view('admin.pages.login');
    }

}
