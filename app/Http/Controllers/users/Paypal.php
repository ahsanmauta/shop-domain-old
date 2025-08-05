<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Auctions;
use App\Models\Payments;
use App\Models\Deposits;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Bids;

class Paypal extends Controller
{
	
	public function buttonPaypal1($id)
	{
		$pageConfigs = ['myLayout' => 'user'];
		$client_id = config('variables.PClientID'); 
		$price = 1.02;
		$currency = 'USD';
	
		return view('content.users.paypal-button', ['pageConfigs' => $pageConfigs,'client_id' => $client_id,'price' => $price,'currency' => $currency ]);
	}
	
	public function depositPaypal()
	{
		$pageConfigs = ['myLayout' => 'user'];
		$client_id = config('variables.PClientID'); 
		$price = 1.02;
		$currency = 'USD';
		$userid = Auth::user()->id;
	
		return view('content.users.paypal-deposit', ['pageConfigs' => $pageConfigs,'client_id' => $client_id,'price' => $price,'currency' => $currency,'userid' => $userid ]);
	}
	
	public function depositsave(Request $request)
	{
		
		if($request->paymentID==''){
			
			return redirect()->back();
		}
		
			
			
			$amount = $request->invoiceAmount;
			$paymentMethod = "PAYPAL";
			$additionalParam = "DEPOSIT";
			$reference = $request->payID;
			$publisherOrderId = $request->paymentID;
			
			$user = User::find(Auth::user()->id);
			$kurs = $user->kurs;
			$user->saldo = $user->saldo + $amount;
			$user->save();
			
			$deposits = Deposits::create([
				'tanggal' => date('Y-m-d'),
				'kurs' => $kurs,
				'amount' => $amount,
				'tipebayar' => $paymentMethod,
				'note' => $additionalParam,
				'reference' => $reference,
				'paymentorderid' => $publisherOrderId,
				'iduser' => Auth::user()->id,
			]);		
			
			return redirect()->route('users.deposit.index');
		
	}
	
	public function paymentPaypal($id)
	{
		$pageConfigs = ['myLayout' => 'user'];
		$client_id = config('variables.PClientID'); 
		$currency = 'USD';
		$userid = Auth::user()->id;
		
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
							->where('bidstatus', 2)
							->select('auctionbids.*')
							->orderBy('bidprice','DESC')
							->first();
		if(!isset($bids)){
			
			Session::flash('message', 'Payment cannot process because paid or not ones win');
			return redirect()->back();
			
		}

		
		$saldo = Auth::user()->saldo;
		
		return view('content.users.paypal-payment', ['pageConfigs' => $pageConfigs,'auction' => $auction,'maxprice' => $maxprice,'bidcount' => $bidcount,'minprice' => $minprice,'bids' => $bids,'saldo' => $saldo,'client_id' => $client_id,'currency' => $currency,'$userid' => $userid]);
	}
	
	public function paymentsave(Request $request)
	{
		
		if($request->paymentID==''){
			
			return redirect()->back();
		}
		
			
			
			$amount = $request->invoiceAmount;
			$paymentMethod = "PAYPAL";
			$additionalParam = "PAYMENT";
			$reference = $request->payID;
			$publisherOrderId = $request->paymentID;
			$id = $request->idbid;
			$amountdp = $request->invoiceDeposit;
			
			$user = User::find(Auth::user()->id);
			$kurs = $user->kurs;
			$user->saldo = $user->saldo - $amount;
			$user->save();
			
			$bids = Bids::find($id);
			$bids->bidstatus = 3;
			$bids->save();
			
			
			$payments = Payments::create([
				'tanggal' => date('Y-m-d'),
				'idauctionbids' => $bids->id,
				'kurs' => $kurs,
				'amountdp' => $amountdp,
				'amount' => $amount,
				'tipebayar' => $paymentMethod,
				'note' => $additionalParam,
				'reference' => $reference,
				'paymentorderid' => $publisherOrderId,
				'iduser' => Auth::user()->id,
			]);			
			
			return redirect()->route('users.payment.index');
		
	}
	
	public function buttonPaypal2($id)
	{
		$pageConfigs = ['myLayout' => 'user'];
		$client_id = config('variables.PClientID'); 
	
		return view('content.users.paypal-button-detail', ['pageConfigs' => $pageConfigs,'client_id' => $client_id ]);
	}
	
	public function gettoken()
	{
		

		$params = "grant_type=client_credentials";
		
		$url = config('variables.PurlToken'); 
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
		curl_setopt($ch, CURLOPT_USERPWD, config('variables.PClientID').":".config('variables.PSecret')); 		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/x-www-form-urlencoded'
			)
		);   
		//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

		//execute post
		$request = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if($httpCode == 200)
		{
			$result = json_decode($request, true);
			$access_token = $result['access_token'];
			return $access_token;

		}
		else
		{
			$request = json_decode($request);
			//$error_message = "Server Error " . $httpCode ." ". $request->Message;
			//echo $error_message;
			return '';
		}
		
	}
	
	public function depositback()
	{
		$paymentId = (isset($_GET['paymentId']) ? $_GET['paymentId'] : null );
		$token = (isset($_GET['token']) ? $_GET['token'] : null );
		$PayerID = (isset($_GET['PayerID']) ? $_GET['PayerID'] : null );

		if(is_null($paymentId) || is_null($token) || is_null($PayerID))
		{
			return redirect()->route('users.pages-user');
		}
		
	}
	
	public function paymentback()
	{
		$paymentId = (isset($_GET['paymentId']) ? $_GET['paymentId'] : null );
		$token = (isset($_GET['token']) ? $_GET['token'] : null );
		$PayerID = (isset($_GET['PayerID']) ? $_GET['PayerID'] : null );

		if(is_null($paymentId) || is_null($token) || is_null($PayerID))
		{
			return redirect()->route('users.pages-user');
		}
		
	}
}
?>