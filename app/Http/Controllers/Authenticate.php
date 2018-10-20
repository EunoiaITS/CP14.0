<?php

namespace App\Http\Controllers;

use App\VehiclesData;
use Illuminate\Http\Request;
use App\User;
use App\User_data;
use App\DriverData;
use App\RideRequestTemp;
use App\VerifyUsers;
use App\Countries;
use Illuminate\Support\Facades\Session;
use DateTime;

class Authenticate extends Controller
{

    public function join(Request $request){
        return view('frontend.pages.join');
    }

    public function registerDriver(Request $request){
        $errors = array();
        $countries = Countries::orderBy('name','asc')->get();
        if($request->isMethod('post')){
            if($request->password !== $request->repass){
                $errors[] = 'Passwords didn\'t match !!';
            }
            if ($request->email !== $request->reemail){
                $errors[] = 'Email didn\'t match !!';
            }
            if (!isset($request->checkbox)){
                $errors[] = 'Please Agree to the Privacy Agreement & Terms of Conditions. !!';
            }
            $user = new User();
            $usd = new User_data();
            $dd = new DriverData();
            $vd = new VehiclesData();
            $data = $request->all();
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
                $user->status = 'not-verified';
                $user->save();
                $last_id = User::orderBy('id', 'desc')->first();
                $usd->user_id = $last_id->id;
                $usd->last_name = $request->last_name;
                $usd->dob = $request->year.'-'.$request->month.'-'.$request->day;
                $usd->gender = $request->gender;
                $usd->address = $request->address;
                $usd->id_card = $request->id_card;
                $usd->status = $request->status;
                $usd->contact = $request->contact;
                $usd->country_code = $request->country_code;
                $usd->save();
                $dd->user_id = $last_id->id;
                $dd->car_reg = $request->car_reg;
                $dd->driving_license = $request->driving_license;
                $dd->expiry = $request->expiry;
                $dd->save();
                $vd->user_id = $last_id->id;
                $vd->own_vehicle = 1;
                $vd->car_plate_no = $dd->car_reg = $request->car_reg;
                $vd->save();
                if($request->hasFile('dl_picture')) {
                    $image = $request->file('dl_picture');
                    $name = str_slug($last_id->id).'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/drivers/dl');
                    $image->move($destinationPath, $name);
                    $usd->picture = $name;
                    $usd->save();
                }
                if($request->hasFile('idc_picture')) {
                    $image = $request->file('idc_picture');
                    $name = str_slug($last_id->id).'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/drivers/idc');
                    $image->move($destinationPath, $name);
                    $usd->idc_picture = $name;
                    $usd->save();
                }

                $linkExtension = $this->generateRandomString();
                $link = url('/account/user/verify').'?link='.$linkExtension;

                $transport = (new \Swift_SmtpTransport('ssl://test.getwobo.com', 465))
                    ->setUsername("mail@test.getwobo.com")
                    ->setPassword('6?bxd~bMW,7j');

                $mailer = new \Swift_Mailer($transport);

                $message = new \Swift_Message('Get Wobo - Account verify Link');
                $message->setFrom(['support@getwobo.com' => 'Account verify link - Get Wobo']);
                $message->setTo([$request->email => $request->name]);
                $message->setBody('<html><body>'.
                    '<h1>Hi '.$request->name .',</h1>'.
                    '<p style="font-size:18px;">Your account registration is complete. Please click the button/link below to verify your account.</p>'.
                    '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td>
                          <div>
                          <!--[if mso]>
                              <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://litmus.com" style="height:36px;v-text-anchor:middle;width:150px;" arcsize="5%" strokecolor="#EB7035" fillcolor="#EB7035">
                              <w:anchorlock/>
                              <center style="color:#ffffff;font-family:Helvetica, Arial,sans-serif;font-size:16px;">I am a button &rarr;</center>
                              </v:roundrect>
                              <![endif]-->
                          <a href="'.$link.'" style="background-color:#EB7035;border:1px solid #EB7035;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;">Verify Account &rarr;</a>
                          </div>
                      </td>
                  </tr>
             </table>'.
                    '<br><br>Thank You<br>Get Wobo<br>Customer Care Team</body></html>',
                    'text/html');

                $result = $mailer->send($message);

                $genLink = new VerifyUsers();

                $genLink->email = $request->email;
                $genLink->link = $linkExtension;

                $genLink->save();

                return redirect()
                    ->to('/sign-up/success')
                    ->with('success', 'The Driver is created successfully!!');
            }else{
                return redirect()
                    ->to('/sign-up/driver')
                    ->with('errors', $errors)
                    ->withInput();
            }
        }
        return view('frontend.pages.register-driver',[
            'countries' => $countries,
            'js' => 'frontend.pages.js.register-driver-js'
        ]);
    }

    public function registerCustomer(Request $request){
        $errors = array();
        $countries = Countries::orderBy('name','asc')->get();
        if($request->isMethod('post')){
            if($request->password !== $request->repass){
                $errors[] = 'Passwords didn\'t match !!';
            }
            if ($request->email !== $request->reemail){
                $errors[] = 'Email didn\'t match !!';
            }
            if (!isset($request->checkbox)){
                $errors[] = 'Please Agree to the Privacy Agreement & Terms of Conditions. !!';
            }
            $user = new User();
            $usd = new User_data();
            $rrt = new RideRequestTemp();
            $country =
            $data = $request->all();
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
                $user->status = 'not-verified';
                $user->save();
                $last_id = User::orderBy('id', 'desc')->first();
                $usd->user_id = $last_id->id;
                $usd->last_name = $request->last_name;
                $usd->dob = $request->year.'-'.$request->month.'-'.$request->day;
                $usd->gender = $request->gender;
                $usd->address = $request->address;
                $usd->id_card = $request->id_card;
                $usd->contact = $request->contact;
                $usd->country_code = $request->country_code;
                $usd->save();
                if($request->hasFile('idc_picture')) {
                    $image = $request->file('idc_picture');
                    $name = str_slug($last_id->id).'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/customers/idc');
                    $image->move($destinationPath, $name);
                    $usd->idc_picture = $name;
                    $usd->save();
                }
                if($request->from != ''){
                    $rrt->user_id = $last_id->id;
                    $rrt->place_from = $request->from;
                    $rrt->place_to = $request->to;
                    $rrt_date = date('Y-m-d H:i', strtotime($request->departure_date));
                    $rrt->departure_date = $rrt_date;
                    $rrt->seat_required = 1;
                    $rrt->status = 'processing';
                    $rrt->save();
                }
                $linkExtension = $this->generateRandomString();
                $link = url('/account/user/verify').'?link='.$linkExtension;

                $transport = (new \Swift_SmtpTransport('ssl://test.getwobo.com', 465))
                    ->setUsername("mail@test.getwobo.com")
                    ->setPassword('6?bxd~bMW,7j');

                $mailer = new \Swift_Mailer($transport);

                $message = new \Swift_Message('Get Wobo - Account verify Link');
                $message->setFrom(['support@getwobo.com' => 'Account verify link - Get Wobo']);
                $message->setTo([$request->email => $request->name]);
                $message->setBody('<html><body>'.
                    '<h1>Hi '.$request->name .',</h1>'.
                    '<p style="font-size:18px;">Your account registration is complete. Please click the button/link below to verify your account.</p>'.
                    '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td>
                          <div>
                          <!--[if mso]>
                              <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://litmus.com" style="height:36px;v-text-anchor:middle;width:150px;" arcsize="5%" strokecolor="#EB7035" fillcolor="#EB7035">
                              <w:anchorlock/>
                              <center style="color:#ffffff;font-family:Helvetica, Arial,sans-serif;font-size:16px;">I am a button &rarr;</center>
                              </v:roundrect>
                              <![endif]-->
                          <a href="'.$link.'" style="background-color:#EB7035;border:1px solid #EB7035;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;">Verify Account &rarr;</a>
                          </div>
                      </td>
                  </tr>
             </table>'.
                    '<br><br>Thank You<br>Get Wobo<br>Customer Care Team</body></html>',
                    'text/html');

                $result = $mailer->send($message);

                $genLink = new VerifyUsers();

                $genLink->email = $request->email;
                $genLink->link = $linkExtension;

                $genLink->save();

                return redirect()
                    ->to('/sign-up/success')
                    ->with('success', 'Registration is successful !!');
            }else{
                return redirect()
                    ->to('/sign-up/customer')
                    ->with('errors',$errors)
                    ->withInput();
            }
        }
        return view('frontend.pages.register-customer',[
            'data' => $request->all(),
            'countries' => $countries,
            'js' => 'frontend.pages.js.register-customer-js'
        ]);
    }

    public function loginDriver(Request $request){
        return view('frontend.pages.login');
    }
    public function success(Request $request){
        return view('frontend.pages.register-success');
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
