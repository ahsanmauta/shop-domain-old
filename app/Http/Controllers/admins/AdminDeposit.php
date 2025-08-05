<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deposits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminDeposit extends Controller
{
  public function index()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.deposit_list',['tipe' => 0,'judul' => 'ALL DEPOSITS']);
  }
  
  public function depositlist($id)
  {
	  if($id==0){
		  return [
				'status' => 'success',
				'data'   => Deposits::leftjoin('users','users.id','=','deposit.iduser')
								->select('deposit.*','users.name','users.firstname','users.lastname')
								->get(),
			];
	  }
	  if($id==1){
		  return [
				'status' => 'success',
				'data'   => Deposits::leftjoin('users','users.id','=','deposit.iduser')
								->select('deposit.*','users.name','users.firstname','users.lastname')
								->where('deposit.tipebayar','!=','PAYPAL')
								->get(),
			];
	  }
	  if($id==2){
		  return [
				'status' => 'success',
				'data'   => Deposits::leftjoin('users','users.id','=','deposit.iduser')
								->select('deposit.*','users.name','users.firstname','users.lastname')
								->where('deposit.tipebayar','=','PAYPAL')
								->get(),
			];
	  }
  }
  
  public function destroy(Request $request,$id)
  {

	  $deposits = Deposits::where('id', $request->id)->firstorfail()->delete(); 
	  
	  Session::flash('success', 'success '.$request->reference.' deleted.');
	 
      return redirect()->route('admin.admindeposit.index'); 

  }
  
  public function show($id)
  {

		$deposit = Deposits::leftjoin('users','users.id','=','deposit.iduser')
						->where('deposit.id',$id)
						->select('deposit.*','users.firstname','users.lastname','users.name')
						->first();

		return view('content.admins.deposit_show', ['deposit' => $deposit]);

  } 
  
  public function admindeposit1()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.deposit_list',['tipe' => 1,'judul' => 'DUITKU DEPOSITS']);
  }
  
  public function admindeposit2()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.deposit_list',['tipe' => 2,'judul' => 'PAYPAL DEPOSITS']);
  }
  
}
