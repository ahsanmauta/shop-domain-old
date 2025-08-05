<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Auctions;
use App\Models\Bids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Domain extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
	$auctions = Auctions::where('endtime', '>', Carbon::now())
						->get();
	$teks = '';
	foreach($auctions as $auction)
	{
		
		$jumlahbid = Auctions::join('auctionbids', 'auctionbids.idauction', '=', 'auction.id')
						->where('auction.id',$auction->id)
						->get()->count();
		
		$teks .= '
				<div class="domain-list-single">
					<div class="left">
						<div class="domain">
							<a class="text--base" href="'.route('bidview',$auction->id).'">
								'.$auction->domain.'
							</a>

						</div>
						<div class="traffic">'.$auction->traffic.'</div>
						<div class="bid">'.$jumlahbid.'</div>
					</div>
					<div class="right">
						<div class="price"><b>$'.$auction->price.'</b></div>
						<div class="action">
										<a href="'.route('users.bidnow',$auction->id).'" class="btn btn-sm btn-outline--base py-1 px-3">Bid Now</a>
									</div>
					</div>
				</div>';

	}
	
	return view('content.front-pages.domains', ['pageConfigs' => $pageConfigs,'auctions' => $auctions,'teks' => $teks]);
  }
  
  public function filter(Request $request)
  {
    $pageConfigs = ['myLayout' => 'front'];
	
						
	$sort = $request->sort;			
	$min = $request->min;		
	$max = $request->max;	
	$search = $request->search;	
	$paginateValue = $request->paginateValue;	
	$extensions = $request->extensions;	
	//var_dump($request->all());
	//exit();
	
	if($sort=='id_desc'){
		$sort1 = 'id'; 
		$sort2 = 'DESC';
	}
	if($sort=='id_asc'){
		$sort1 = 'id'; 
		$sort2 = 'ASC';
	}
	if($sort=='price_asc'){
		$sort1 = 'price'; 
		$sort2 = 'ASC';
	}
	if($sort=='price_desc'){
		$sort1 = 'price'; 
		$sort2 = 'DESC';
	}
	
	if(isset($sort)){
		$auctions = Auctions::where('endtime', '>', Carbon::now())
						->where('auction.price','>=',$min)
						->where('auction.price','<=',$max)
						->where('auction.domain','LIKE','%'.$search.'%')
						->orderBy($sort1,$sort2)
						->get();
	}else{
		$auctions = Auctions::where('endtime', '>', Carbon::now())
						->where('auction.price','>=',$min)
						->where('auction.price','<=',$max)
						->where('auction.domain','LIKE','%'.$search.'%')
						->get();	
	}
						
	$teks = '';
	foreach($auctions as $auction)
	{
		
		$jumlahbid = Auctions::join('auctionbids', 'auctionbids.idauction', '=', 'auction.id')
						->where('auction.id',$auction->id)
						->get()->count();
		
		if(isset($extensions)){
			foreach($extensions as $extension){
				if(substr($auction->domain,-1*strlen($extension))==$extension){
					$teks .= '
						<div class="domain-list-single">
							<div class="left">
								<div class="domain">
									<a class="text--base" href="'.route('bidview',$auction->id).'">
										'.$auction->domain.'
									</a>

								</div>
								<div class="traffic">'.$auction->traffic.'</div>
								<div class="bid">'.$jumlahbid.'</div>
							</div>
							<div class="right">
								<div class="price"><b>$'.$auction->price.'</b></div>
								<div class="action">
												<a href="'.route('users.bidnow',$auction->id).'" class="btn btn-sm btn-outline--base py-1 px-3">Bid Now</a>
											</div>
							</div>
						</div>';
				}
				
			}
		}else{
			$teks .= '
						<div class="domain-list-single">
							<div class="left">
								<div class="domain">
									<a class="text--base" href="'.route('bidview',$auction->id).'">
										'.$auction->domain.'
									</a>

								</div>
								<div class="traffic">'.$auction->traffic.'</div>
								<div class="bid">'.$jumlahbid.'</div>
							</div>
							<div class="right">
								<div class="price"><b>$'.$auction->price.'</b></div>
								<div class="action">
												<a href="'.route('users.bidnow',$auction->id).'" class="btn btn-sm btn-outline--base py-1 px-3">Bid Now</a>
											</div>
							</div>
						</div>';
		}

	}
	

	echo $teks;
	
	//return view('content.front-pages.domains', ['pageConfigs' => $pageConfigs,'auctions' => $auctions]);
  }
  
  public function bidnow($id)
  {
    $pageConfigs = ['myLayout' => 'front'];
	
	if(Auth::user()->saldo<=config('variables.minSaldoBid')){
		
		return redirect()->route('users.deposit.create');
		
	}
	
	
	$auction = Auctions::where('id', $id)
						->first();
	$maxprice = Bids::where('idauction', $id)
						->orderBy('bidprice','DESC')
						->first();
	$bidcount = Bids::where('idauction', $id)
						->get()
						->count();
	if($bidcount>0){
		$minprice = $maxprice->bidprice;
	}else{
		$minprice = $auction->price;
	}
	
	
	return view('content.front-pages.bidnow', ['pageConfigs' => $pageConfigs,'auction' => $auction,'maxprice' => $maxprice,'bidcount' => $bidcount,'minprice' => $minprice]);
  }
  
  public function bidsave(Request $request)
  {
    if(!isset($request->price)){
			
			Session::flash('message', 'Please check price');
			return redirect()->back();
			
		}
	if(!isset($request->idauction)){
			
			Session::flash('message', 'Please auction domain');
			return redirect()->back();
			
		}
	if(!isset($request->minprice)){
			
			Session::flash('message', 'Please fill min price domain');
			return redirect()->back();
			
		}
		
	if($request->minprice>$request->price){
			
			Session::flash('message', 'Please price bid more than min price domain');
			return redirect()->back();
			
		}
		
	$bids = Bids::create([
            'idauction' => $request->idauction,
			'bidprice' => $request->price,
			'bidstatus' => 1,
			'iduser' =>  Auth::user()->id
        ]);
		
	Session::flash('message', 'Bid success created.');
    return redirect()->route('users.bidnow',$request->idauction);
  }
  
  public function bidview($id)
  {
    $pageConfigs = ['myLayout' => 'front'];
	$auction = Auctions::where('id', $id)
						->first();
	$maxprice = Bids::where('idauction', $id)
						->orderBy('bidprice','DESC')
						->first();
	$bidcount = Bids::where('idauction', $id)
						->get()
						->count();
	if($bidcount>0){
		$minprice = $maxprice->bidprice;
	}else{
		$minprice = $auction->price;
	}
	$bids = Bids::join('users','users.id','=','auctionbids.iduser')
						->where('idauction', $id)
						->orderBy('bidprice','DESC')
						->get();
	
	return view('content.front-pages.bidview', ['pageConfigs' => $pageConfigs,'auction' => $auction,'maxprice' => $maxprice,'bidcount' => $bidcount,'minprice' => $minprice,'bids' => $bids]);
  }
  
  public function bidwinnners($id)
  {
    $pageConfigs = ['myLayout' => 'front'];
	$auction = Auctions::where('id', $id)
						->first();
	if($auction->iduser!=Auth::user()->id){
		return redirect()->route('pages-misc-error');
	}
						
	$maxprice = Bids::where('idauction', $id)
						->orderBy('bidprice','DESC')
						->first();
	$bidcount = Bids::where('idauction', $id)
						->get()
						->count();
	if($bidcount>0){
		$minprice = $maxprice->bidprice;
	}else{
		$minprice = $auction->price;
	}
	$bids = Bids::join('users','users.id','=','auctionbids.iduser')
						->select('auctionbids.*','users.firstname','users.lastname','users.name','users.email')
						->where('idauction', $id)
						->orderBy('bidprice','DESC')
						->get();
	
	return view('content.front-pages.bidwinners', ['pageConfigs' => $pageConfigs,'auction' => $auction,'maxprice' => $maxprice,'bidcount' => $bidcount,'minprice' => $minprice,'bids' => $bids]);
  }
  
  public function winsave(Request $request)
  {
    if(!isset($request->idbid)){
			
			Session::flash('message', 'Please check bid id');
			return redirect()->back();
			
		}

	$bids = Bids::find($request->idbid);
	$id=$bids->idauction;
    $bids->bidstatus = 2;
    $bids->save();
	
	
	
	Session::flash('message', 'Bid success update.');
    return redirect()->route('users.bidwinnners',$id);
  }
  
}
