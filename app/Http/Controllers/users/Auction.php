<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Auctions;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Auction extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'user'];
	$auctions = Auctions::where('iduser',Auth::user()->id)
						->get();
	
    return view('content.users.auction-list', ['pageConfigs' => $pageConfigs,'auctions' => $auctions]);
  }
  
  public function create()
  {
    $pageConfigs = ['myLayout' => 'user'];
    return view('content.users.auction-register', ['pageConfigs' => $pageConfigs]);
  }
  
  public function store(Request $request)
    {
        
		if(!isset($request->domain)){
			
			Session::flash('message', 'Please check domain name');
			return redirect()->back();
			
		}
		
		$auctions = Auctions::create([
            'domain' => $request->domain,
			'category' => $request->category,
			'price' => $request->price,
			'register' => $request->register,
            'endtime' => $request->endtime,
            'country' => $request->country,
            'traffic' => $request->traffic,
			'about' => $request->about,
			'sellernote' => $request->sellernote,
			'verificationcode' => $request->verificationcode,
			'status' => '1',
			'iduser' =>  Auth::user()->id
        ]);
		
		Session::flash('message', 'Auction success created.');
        return redirect()->route('users.auction.index');
		
    }
  
}
