<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPayment extends Controller
{
  public function index()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.payment_list',['tipe' => 1,'judul' => 'ALL PAYMENTS']);
  }
  
  public function paymentlist($id)
  {
	  if($id==0){
	  return [
			'status' => 'success',
			'data'   => Payments::leftjoin('users','users.id','=','payment.iduser')
							->leftjoin('auctionbids','auctionbids.id','=','payment.idauctionbids')
							->leftjoin('auction','auction.id','=','auctionbids.idauction')
							->select('payment.*','users.name','users.firstname','users.lastname','auction.domain','auctionbids.bidstatus')
							->get(),
		];
	  }
	  if($id==1){
	  return [
			'status' => 'success',
			'data'   => Payments::leftjoin('users','users.id','=','payment.iduser')
							->leftjoin('auctionbids','auctionbids.id','=','payment.idauctionbids')
							->leftjoin('auction','auction.id','=','auctionbids.idauction')
							->select('payment.*','users.name','users.firstname','users.lastname','auction.domain','auctionbids.bidstatus')
							->where('payment.tipebayar','!=','PAYPAL')
							->get(),
		];
	  }
	  if($id==2){
	  return [
			'status' => 'success',
			'data'   => Payments::leftjoin('users','users.id','=','payment.iduser')
							->leftjoin('auctionbids','auctionbids.id','=','payment.idauctionbids')
							->leftjoin('auction','auction.id','=','auctionbids.idauction')
							->select('payment.*','users.name','users.firstname','users.lastname','auction.domain','auctionbids.bidstatus')
							->where('payment.tipebayar','=','PAYPAL')
							->get(),
		];
	  }
  }
  
  public function destroy(Request $request,$id)
  {

	  $payments = Payments::where('id', $request->id)->firstorfail()->delete(); 
	  
	  Session::flash('success', 'success '.$request->reference.' deleted.');
	 
      return redirect()->route('admin.adminpayment.index'); 

  }
  
  
  public function show($id)
  {

		$payment = Payments::leftjoin('users','users.id','=','payment.iduser')
						->where('payment.id',$id)
						->select('payment.*','users.firstname','users.lastname','users.name')
						->first();

		return view('content.admins.payment_show', ['payment' => $payment]);

  } 
  
  public function adminpayment1()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.payment_list',['tipe' => 1,'judul' => 'DUITKU PAYMENTS']);
  }
  
  public function adminpayment2()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.payment_list',['tipe' => 1,'judul' => 'PAYPAL PAYMENTS']);
  }
  
}
