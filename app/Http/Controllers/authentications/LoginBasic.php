<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LoginBasic extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
  }
  
  public function login(Request $request)
  {
		/*$this->validate($request, [
        'login'    => 'required',
        'password' => 'required',
		]);*/

		$login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL ) 
			? 'email' 
			: 'name';

		$request->merge([
			$login_type => $request->input('login')
		]);

		if (Auth::attempt($request->only($login_type, 'password'))) {
			return redirect()->route('users.pages-user');
		}

		return redirect()->back()
			->withInput()
			->withErrors([
				'login' => 'These credentials do not match our records.',
			]);
		 
		

		

  }
  
  public function logout()
  {
	  Auth::logout();

      //$request->session()->invalidate();

      //$request->session()->regenerateToken();

      return redirect('/login');
	  
  }
  
  public function username()
  {
		return 'name';
  }
  
  public function change()
  {
	$pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-reset-password-basic', ['pageConfigs' => $pageConfigs]);
  }
  
  public function passreset(Request $request)
  {
		
		if($request->input('password')==null){
			return redirect()->back()
			->withInput()
			->withErrors([
				'login' => 'Password cannot empty',
			]);
		}
			
		if ($request->input('password')==$request->input('confirm-password')) {
			User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
			return redirect()->route('login')->withErrors([
				'login' => 'Update password success',
			]);
		}else{
			
			return redirect()->back()
			->withInput()
			->withErrors([
				'login' => 'Password and Confirm Password must same',
			]);
			
		}

	

  }
  
  public function freset()
  {
	$pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-forgot-password-basic', ['pageConfigs' => $pageConfigs]);
  }
  
  public function resetpassword(Request $request)
  {
		
		if($request->input('email')==null){
			return redirect()->back()
			->withInput()
			->withErrors([
				'login' => 'Email cannot empty',
			]);
		}
		
		$token = Str::random(64);
			
		if ($token) {

			$user = User::where('email',$request->input('email'))
						->first();
			$user->remember_token = $token;
			$user->update();
			
			
			Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->input('email'));
              $message->subject('Reset Password');
            });
			
			
			return redirect()->back()
			->withInput()
			->withErrors([
				'login' => 'We have e-mailed your password reset link!',
			]);
			
		}else{
			
			return redirect()->back()
			->withInput()
			->withErrors([
				'login' => 'Token cannot empty',
			]);
			
		}

	

  }
  public function forget($id)
  {
	$user = User::where('remember_token',$id)
						->first();
	if(!isset($user)){
		
		return redirect()->route('login');
		
	}
	
	Session::put('forgetid', $user->id);
	
	$pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-reset-password-forget', ['pageConfigs' => $pageConfigs]);
  }
  
  public function forgetsave(Request $request)
  {
		
		if($request->input('password')==null){
			return redirect()->back()
			->withInput()
			->withErrors([
				'login' => 'Password cannot empty',
			]);
		}
			
		if ($request->input('password')==$request->input('confirm-password')) {
			User::findOrFail(Session::get('forgetid'))->update([
                'password' => Hash::make($request->password),
            ]);
			return redirect()->route('login')->withErrors([
				'login' => 'Update password success',
			]);
		}else{
			
			return redirect()->back()
			->withInput()
			->withErrors([
				'login' => 'Password and Confirm Password must same',
			]);
			
		}
		

  }
	
}
