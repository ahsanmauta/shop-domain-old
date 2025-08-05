<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use Illuminate\Support\Facades\Mail;

class AdminUser extends Controller
{
  public function index()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.user_list',['tipe' => 0,'judul' => 'ALL USERS']);
  }
  
  public function userlist($id)
  {
	  if($id==0)
	  {
		  return [
				'status' => 'success',
				'data'   => User::all(),
			];
	  }
	  if($id==1)
	  {
		  return [
				'status' => 'success',
				'data'   => User::where('active','=',1)
							->get(),
			];
	  }
  }
  
  public function destroy(Request $request,$id)
  {

	  $user = User::where('id', $request->id)->firstorfail()->delete(); 
	  
	  Session::flash('success', 'success '.$request->username.' deleted.');
	 
      return redirect()->route('admin.adminuser.index'); 

  }
  
  public function show($id)
  {

		$user = User::findOrFail($id);
		$country = Country::all();
		return view('content.admins.user_show', ['user' => $user,'country' => $country]);

  }  
  
  public function edit($id)
  {

		$user = User::findOrFail($id);
		$country = Country::all();
		return view('content.admins.user_edit', ['user' => $user,'country' => $country]);

  } 
  
  public function update(Request $request,$id)
  {
		$request->validate([
            //'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
            'firstname'     => 'required|min:2',
            'lastname'   => 'required|min:2'
        ]);
		
		$user = User::findOrFail($id);
		$user->firstname = $request->firstname;
		$user->lastname = $request->lastname;
		$user->country = $request->country;
		$user->mobile = $request->mobile;
		$user->address = $request->address;
		$user->state = $request->state;
		$user->zipcode = $request->zipcode;
		$user->city = $request->city;
		$user->save();
		
		return redirect()->route('admin.adminuser.index',$id)
						->with(['success' => 'Update success!']);
  
  }
  
  public function sendemail()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	
	$users = User::all();
	return view('content.admins.user_sendemail',['users' => $users]);
  }
  
  public function emailsave(Request $request)
  {
	  
	  $email = $request->email;
	  foreach($email as $em)
	  {
		  $tujuan = $em;
		  $subject = $request->subject;
		  $messages = $request->message;
		  Mail::send('email.user-sendemail', ['messages' => $messages], function($message) use($tujuan,$subject){
				  $message->to($tujuan);
				  $message->subject($subject);
				});
	  }	

	  return redirect()->route('admin.admin-sendemail')
						->with(['success' => 'Send Email success!']);	  
	  
  }
  
  public function userlistactive()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.user_list',['tipe' => 1,'judul' => 'ACTIVE USERS']);
  }
  
  public function usersuspend($id)
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	  
	$user = User::findOrFail($id);
	$user->active = 0;
	$user->update();
	
	return view('content.admins.user_list',['tipe' => 0,'judul' => 'ALL USERS']);
  }
  
  
}
