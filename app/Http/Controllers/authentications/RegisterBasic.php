<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterBasic extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-register-basic', ['pageConfigs' => $pageConfigs]);
  }
  
  public function actionregister1(Request $request)
    {
        
		$request->validate([
            'firstname' => 'required',
            'email' => 'required|email',
            'lastname' => 'required',
        ]);

		$SECRET_KEY = env('RECAPTCHA_SECRET_KEY');    # replace with your secret key
		$VERIFY_URL = "https://api.hcaptcha.com/siteverify";
		$token = $request['h-captcha-response'];
		
		$post = [
			'secret' => $SECRET_KEY,
			'response' => $token
		];
		
		$post="secret=".$SECRET_KEY."&response=".$token;
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,$VERIFY_URL);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec($ch);

		curl_close($ch);
		
		$server_output = json_decode($server_output, true);

		if (!$server_output['success']) 
		{  
			return redirect()->route('login');
		}

		
		if(!isset($request->terms)){
			
			Session::flash('message', 'Please check privacy policy & terms');
			return redirect()->back();
			
		}
		
		if($request->password!=$request->cpassword){
			
			Session::flash('message', 'Please fill password and confirm password same');
			return redirect()->back();
			
		}
		
		Session::put('firstname', $request->firstname);
		Session::put('lastname', $request->lastname);
		Session::put('email', $request->email);
		Session::put('password', $request->password);
		Session::put('cpassword', $request->cpassword);
		Session::put('terms', $request->terms);

        Session::flash('message', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');
        $pageConfigs = ['myLayout' => 'blank'];
		$country = Country::all();
		
		return view('content.authentications.auth-register-detail', ['pageConfigs' => $pageConfigs,'country' => $country]);
    }
  
  public function actionregister2(Request $request)
    {
        $user = User::create([
            'firstname' => Session::get('firstname'),
			'lastname' => Session::get('lastname'),
			'email' => Session::get('email'),
			'password' => Hash::make(Session::get('password')),
            'name' => $request->username,
            'country' => $request->country,
            'mobile' => $request->mobile,
			'address' => $request->address,
			'state' => $request->state,
			'zipcode' => $request->zipcode,
			'city' => $request->city,
            'active' => 1
        ]);
		
		Auth::login($user);
        Session::flash('message', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');
		return redirect()->route('users.pages-user');
    }
	
  public function reloadcaptcha()
  {
    return response()->json(['captcha'=> captcha_img()]);
  }
  
}
