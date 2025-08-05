<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use App\Models\User;
use App\Models\Auctions;
use App\Models\Bids;


class FPageUser extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'user'];
	$jml_domains = Auctions::where('iduser',Auth::user()->id)
						->get()
						->count();
						
	$domains = Auctions::where('iduser',Auth::user()->id)
						->get();
						
	$jml_bids = Auctions::join('auctionbids', 'auctionbids.idauction', '=', 'auction.id')
						->where('auctionbids.iduser',Auth::user()->id)
						->get()
						->count();
	
	$bids = Auctions::join('auctionbids', 'auctionbids.idauction', '=', 'auction.id')
						->where('auctionbids.iduser',Auth::user()->id)
						->get();
						
	return view('content.users.front', ['pageConfigs' => $pageConfigs,'jml_domains' => $jml_domains,'jml_bids' => $jml_bids,'domains' => $domains,'bids' => $bids]);
  }
  
  public function edit($id)
  {
    $pageConfigs = ['myLayout' => 'user'];
	$user = Auth::user();
	$country = Country::all();
	return view('content.users.puser-edit', ['pageConfigs' => $pageConfigs,'user' => $user,'country' => $country]);
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
		
		return redirect()->route('users.puser.edit',$id)
						->with(['success' => 'Update Profile Setting is success!']);
  
  }
  
}
