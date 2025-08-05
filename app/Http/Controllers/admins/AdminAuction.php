<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auctions;
use App\Models\Bids;
use App\Models\User;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AdminAuction extends Controller
{

   
  public function index()
  {
    
	if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	  
	/*$bidwin = Bids::leftjoin('auction','auctionbids.idauction','=','auction.id')
							->leftjoin('users','users.id','=','auctionbids.iduser')
							->select('auctionbids.*','auction.domain','auction.category','auction.price','auction.endtime','users.name','users.firstname','users.lastname')
							->where('auctionbids.bidstatus','=',2)
							->get()->count();*/
	
	return view('content.admins.auction_list');
  }
  
  public function auctionlist()
  {
	  return [
			'status' => 'success',
			'data'   => Auctions::leftjoin('users','users.id','=','auction.iduser')
							->select('auction.*','users.name','users.firstname','users.lastname')
							->get(),
		];
  }
  
  public function indexbid()
  {
    
	if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	  
	return view('content.admins.auction_bid');
  }
  
  public function bidlist()
  {
	  return [
			'status' => 'success',
			'data'   => Bids::leftjoin('auction','auctionbids.idauction','=','auction.id')
							->leftjoin('users','users.id','=','auctionbids.iduser')
							->select('auctionbids.*','auction.domain','auction.category','auction.price','auction.endtime','users.name','users.firstname','users.lastname')
							->get(),
		];
  }
  
  public function destroy(Request $request,$id)
  {

	  $auctions = Auctions::where('id', $request->id)->firstorfail()->delete(); 
	  
	  Session::flash('success', 'success '.$request->domain.' deleted.');
	 
      return redirect()->route('admin.adminauction.index'); 

  }
  
  public function destroybid(Request $request,$id)
  {

	  $bids = Bids::where('id', $request->id)->firstorfail()->delete(); 
	  
	  Session::flash('success', 'success bids '.$request->domain.' deleted.');
	 
      return redirect()->route('admin.admin-indexbid'); 

  }
  
  public function show($id)
  {

		$auctions = Auctions::findOrFail($id);
		$userauction = User::where('id',$auctions->iduser)
							->first();

		return view('content.admins.auction_show', ['auctions' => $auctions,'userauction' => $userauction]);

  } 
  
  public function bidlistbyauction($id)
  {
	  return [
			'status' => 'success',
			'data'   => Bids::leftjoin('auction','auctionbids.idauction','=','auction.id')
							->leftjoin('users','users.id','=','auctionbids.iduser')
							->where('auction.id','=',$id)
							->select('auctionbids.*','auction.domain','auction.category','auction.price','auction.endtime','users.name','users.firstname','users.lastname')
							->get(),
		];
  }
  
  public function bidshow($id)
  {

		$auctions = Auctions::findOrFail($id);
		$userauction = User::where('id',$auctions->iduser)
							->first();

		return view('content.admins.auction_show', ['auctions' => $auctions,'userauction' => $userauction]);

  } 
  
  public function auctionwin()
  {
    
	if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	  
	return view('content.admins.auction_win');
  }
  
  public function bidwin()
  {
	  return [
			'status' => 'success',
			'data'   => Bids::leftjoin('auction','auctionbids.idauction','=','auction.id')
							->leftjoin('users','users.id','=','auctionbids.iduser')
							->select('auctionbids.*','auction.domain','auction.category','auction.price','auction.endtime','users.name','users.firstname','users.lastname')
							->where('auctionbids.bidstatus','=',2)
							->get(),
		];
  }
  
  public function auctionpaid()
  {
    
	if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	  
	return view('content.admins.auction_paid');
  }
  
  public function bidpaid()
  {
	  return [
			'status' => 'success',
			'data'   => Bids::leftjoin('auction','auctionbids.idauction','=','auction.id')
							->leftjoin('users','users.id','=','auctionbids.iduser')
							->select('auctionbids.*','auction.domain','auction.category','auction.price','auction.endtime','users.name','users.firstname','users.lastname')
							->where('auctionbids.bidstatus','=',3)
							->get(),
		];
  }
  
}
