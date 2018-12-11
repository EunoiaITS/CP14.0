<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\UsersExtendedData;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

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
        if($user->status == 'not-verified'){
            Auth::logout();
            return redirect('/login')
                ->with('error', 'Account is not Verified !! Please Check your email for Verification !!');
        }
        if($user->status == 'blocked'){
            Auth::logout();
            return redirect('/login')
                ->with('error', 'This account has been deactivated. To activate the account please contact with the admin.');
        }
        if($user->role != 'super-admin'){
            $request->session()->forget('area');
            $request->session()->forget('lat');
            $request->session()->forget('lan');
            $c_data = UsersExtendedData::where(['user_id' => $user->id])->get();
            if(!empty($c_data)){
                foreach($c_data as $c){
                    if($c->key == 'country'){
                        session(['area' => $c->value]);
                        Cookie::queue('area', $c->value, 300);
                    }
                }
                foreach($c_data as $c){
                    if($c->key == 'lat'){
                        session(['lat' => $c->value]);
                        Cookie::queue('lat', $c->value, 300);
                    }
                }
                foreach($c_data as $c){
                    if($c->key == 'lan'){
                        session(['lan' => $c->value]);
                        Cookie::queue('lan', $c->value, 300);
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
