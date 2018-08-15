<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\UsersExtendedData;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user){
        if($user->role != 'super-admin'){
            $request->session()->forget('area');
            $request->session()->forget('lat');
            $request->session()->forget('lan');
            $c_data = UsersExtendedData::where(['user_id' => $user->id])->get();
            if(!empty($c_data)){
                foreach($c_data as $c){
                    if($c->key == 'country'){
                        session(['area' => $c->value]);
                    }
                }
                foreach($c_data as $c){
                    if($c->key == 'lat'){
                        session(['lat' => $c->value]);
                    }
                }
                foreach($c_data as $c){
                    if($c->key == 'lan'){
                        session(['lan' => $c->value]);
                    }
                }
            }
            $check_area = session('area');
            if(!isset($check_area)){
                return redirect()
                    ->to('/choose-country');
            }
        }else{
            return redirect()
                ->to('/admin');
        }
    }

}
