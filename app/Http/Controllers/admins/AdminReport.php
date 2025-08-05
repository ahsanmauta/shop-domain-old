<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Deposits;
use App\Models\Authlog;

class AdminReport extends Controller
{
  public function index()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.pages.pages-home');
  }
  
  public function histlogin()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.history_login');
  }
  
  public function histlogindata()
  {
    return [
				'status' => 'success',
				'data'   => Authlog::leftjoin('users','users.id','=','authentication_logs.user_id')
								->select('authentication_logs.*','users.name','users.firstname','users.lastname')
								->get(),
			];
  }
  
  public function histloginview($id)
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.history_login');
  }
  
  public function histtrans()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.history_trans');
  }
  
  public function histtransdata($id)
  {
    return [
				'status' => 'success',
				'data'   => Deposits::leftjoin('users','users.id','=','deposit.iduser')
								->select('deposit.*','users.name','users.firstname','users.lastname')
								->get(),
			];
  }
  
  public function histnotif()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.history_notif');
  }
  
  public function histnotifdata($id)
  {
    return [
				'status' => 'success',
				'data'   => Deposits::leftjoin('users','users.id','=','deposit.iduser')
								->select('deposit.*','users.name','users.firstname','users.lastname')
								->get(),
			];
  }
  
}
