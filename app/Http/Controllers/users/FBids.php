<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Auctions;
use App\Models\Payments;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Bids;

class FBids extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'user'];
	$auctions = Auctions::join('auctionbids', 'auctionbids.idauction', '=', 'auction.id')
						->where('auctionbids.iduser',Auth::user()->id)
						->get();
	
    return view('content.users.bids-list', ['pageConfigs' => $pageConfigs,'auctions' => $auctions]);
  }
  
  public function bidwinnner()
  {
    $pageConfigs = ['myLayout' => 'user'];
	$auctions = Auctions::join('auctionbids', 'auctionbids.idauction', '=', 'auction.id')
						->where('auctionbids.iduser',Auth::user()->id)
						->where('auctionbids.bidstatus','>',1)
						->get();
	
    return view('content.users.bids-winner', ['pageConfigs' => $pageConfigs,'auctions' => $auctions]);
  }
  
  public function payment($id)
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
						->where('bidstatus', 2)
						->select('auctionbids.*')
						->orderBy('bidprice','DESC')
						->first();
	if(!isset($bids)){
		
		Session::flash('message', 'Payment cannot process because paid or not ones win');
		return redirect()->back();
		
	}

	
    // Set kode merchant anda 
    $merchantCode = config('variables.DmerchantCode'); 
    // Set merchant key anda 
    $apiKey = config('variables.DapiKey'); 
    // catatan: environtment untuk sandbox dan passport berbeda 

    $datetime = date('Y-m-d H:i:s');  
    $paymentAmount = 10000;
    $signature = hash('sha256',$merchantCode . $paymentAmount . $datetime . $apiKey);

    $params = array(
        'merchantcode' => $merchantCode,
        'amount' => $paymentAmount,
        'datetime' => $datetime,
        'signature' => $signature
    );

    $params_string = json_encode($params);

    $url = config('variables.DurlMethod'); 

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($params_string))                                                                       
    );   
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    //execute post
    $request = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($httpCode == 200)
    {
        $results = json_decode($request, true);
		$tipebayar = $results['paymentFee'];
        //print_r($results, false);
    }
    else{
        $request = json_decode($request);
        $error_message = "Server Error " . $httpCode ." ". $request->Message;
        echo $error_message;
		exit();	
    }
	
	$saldo = Auth::user()->saldo;
	
	return view('content.users.bids-payment', ['pageConfigs' => $pageConfigs,'auction' => $auction,'maxprice' => $maxprice,'bidcount' => $bidcount,'minprice' => $minprice,'bids' => $bids,'tipebayar' => $tipebayar,'saldo' => $saldo]);
  }
  
  public function paymentsend(Request $request)
  {
	  
	  if($request->input('invoiceDeposit')>Auth::user()->saldo){  
		  Session::flash('message', 'Please fill deposit amount less than '.Auth::user()->saldo);
		  return redirect()->back();
	  }
	  
	  if($request->input('invoiceAmount')<=0){  
		  Session::flash('message', 'Please fill amount more than 0');
		  return redirect()->back();
	  }
	  
	  if($request->input('payment-method')==""){  
		  Session::flash('message', 'Please fill payment method');
		  return redirect()->back();
	  }
	  
	  if($request->input('payment-note')==""){  
		  Session::flash('message', 'Please fill payment note');
		  return redirect()->back();
	  }
	  
	  if($request->input('idbid')==''){  
		  Session::flash('message', 'Please fill bid');
		  return redirect()->back();
	  }
	  
	  $jumlah = $request->input('invoiceDeposit') + $request->input('invoiceAmount');
	  
	  
	  $bids = Bids::join('auction','auction.id','=','auctionbids.idauction')
						->join('users','users.id','=','auctionbids.iduser')
						->where('auctionbids.id', $request->input('idbid'))
						->where('bidstatus', 2)
						->select('auctionbids.*','auction.domain','users.firstname','users.lastname','users.email','users.mobile','users.address','users.state','users.city','users.zipcode','users.country','users.kurs')
						->first();
						
	if($bids->bidprice!=$jumlah){
		Session::flash('message', 'Please fill invoice balance = deposit + amount right');
		return redirect()->back();
	}
	
	$idbid = $request->input('idbid');
	$bidprice = number_format(($request->input('invoiceAmount')*$bids->kurs),0,"","");
	
    $merchantCode = config('variables.DmerchantCode'); 
    $apiKey = config('variables.DapiKey');
    $paymentAmount = $bidprice;
    $paymentMethod = $request->input('payment-method');
    $merchantOrderId = time() . ''; // dari merchant, unik
    $productDetails = 'payment '.$bids->domain;
    $email = $bids->email;
    $phoneNumber = $bids->mobile; // nomor telepon pelanggan anda (opsional)
    $additionalParam = $request->input('payment-note');
    $merchantUserInfo = Auth::user()->id.','.$idbid.','.$request->input('invoiceDeposit'); // opsional
    $customerVaName = $bids->firstname.' '.$bids->lastname; // tampilan nama pada tampilan konfirmasi bank
    $callbackUrl = url('callback'); // url untuk callback
    $returnUrl = url('updateref');// url untuk redirect
    $expiryPeriod = 10; // atur waktu kadaluarsa dalam hitungan menit
    $signature = md5($merchantCode . $merchantOrderId . $paymentAmount . $apiKey);

    // Customer Detail
    $firstName = $bids->firstname;
    $lastName = $bids->lastname;

    // Address
    $alamat = $bids->address;
    $city = $bids->city;
    $postalCode = $bids->zipcode;
    $countryCode = $bids->country;

    $address = array(
        'firstName' => $firstName,
        'lastName' => $lastName,
        'address' => $alamat,
        'city' => $city,
        'postalCode' => $postalCode,
        'phone' => $phoneNumber,
        'countryCode' => $countryCode
    );

    $customerDetail = array(
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'phoneNumber' => $phoneNumber,
        'billingAddress' => $address,
        'shippingAddress' => $address
    );

    $item1 = array(
        'name' => 'payment',
        'price' => $bidprice,
        'quantity' => 1);

    $itemDetails = array(
        $item1
    );

    /*Khusus untuk metode pembayaran OL dan SL
    $accountLink = array (
        'credentialCode' => '7cXXXXX-XXXX-XXXX-9XXX-944XXXXXXX8',
        'ovo' => array (
            'paymentDetails' => array ( 
                0 => array (
                    'paymentType' => 'CASH',
                    'amount' => 40000,
                ),
            ),
        ),
        'shopee' => array (
            'useCoin' => false,
            'promoId' => '',
        ),
    );*/

    /*Khusus untuk metode pembayaran Kartu Kredit
    $creditCardDetail = array (
        'acquirer' => '014',
        'binWhitelist' => array (
            '014',
            '400000'
        )
    );*/

    $params = array(
        'merchantCode' => $merchantCode,
        'paymentAmount' => $paymentAmount,
        'paymentMethod' => $paymentMethod,
        'merchantOrderId' => $merchantOrderId,
        'productDetails' => $productDetails,
        'additionalParam' => $additionalParam,
        'merchantUserInfo' => $merchantUserInfo,
        'customerVaName' => $customerVaName,
        'email' => $email,
        'phoneNumber' => $phoneNumber,
        //'accountLink' => $accountLink,
        //'creditCardDetail' => $creditCardDetail,
        'itemDetails' => $itemDetails,
        'customerDetail' => $customerDetail,
        'callbackUrl' => $callbackUrl,
        'returnUrl' => $returnUrl,
        'signature' => $signature,
        'expiryPeriod' => $expiryPeriod
    );

    $params_string = json_encode($params);
    //echo $params_string;
    $url = config('variables.DurlInquery'); 
    // $url = 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry'; // Production
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($params_string))                                                                       
    );   
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    //execute post
    $request = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($httpCode == 200)
    {
        $result = json_decode($request, true);
		
		$bids = Bids::find($idbid);
		//$bids->merchantorderid = $merchantOrderId;
		$bids->payment_ref = $result['reference'];
		$bids->save();
	
        header('location: '. $result['paymentUrl']);

    }
    else
    {
        $request = json_decode($request);
        $error_message = "Server Error " . $httpCode ." ". $request->Message;
        echo $error_message;
    }


	  
  }
  
  public function callback()
  {
	
	
	$apiKey = config('variables.DapiKey');
	
	$merchantCode = isset($_POST['merchantCode']) ? $_POST['merchantCode'] : null; 
	$amount = isset($_POST['amount']) ? $_POST['amount'] : null; 
	$merchantOrderId = isset($_POST['merchantOrderId']) ? $_POST['merchantOrderId'] : null; 
	$productDetail = isset($_POST['productDetail']) ? $_POST['productDetail'] : null; 
	$additionalParam = isset($_POST['additionalParam']) ? $_POST['additionalParam'] : null; 
	$paymentMethod = isset($_POST['paymentCode']) ? $_POST['paymentCode'] : null; 
	$resultCode = isset($_POST['resultCode']) ? $_POST['resultCode'] : null; 
	$merchantUserId = isset($_POST['merchantUserId']) ? $_POST['merchantUserId'] : null; 
	$reference = isset($_POST['reference']) ? $_POST['reference'] : null; 
	$signature = isset($_POST['signature']) ? $_POST['signature'] : null; 
	$publisherOrderId = isset($_POST['publisherOrderId']) ? $_POST['publisherOrderId'] : null; 
	$spUserHash = isset($_POST['spUserHash']) ? $_POST['spUserHash'] : null; 
	$settlementDate = isset($_POST['settlementDate']) ? $_POST['settlementDate'] : null; 
	$issuerCode = isset($_POST['issuerCode']) ? $_POST['issuerCode'] : null; 
	
	//log callback untuk debug 
	// file_put_contents('callback.txt', "* Callback *\r\n", FILE_APPEND | LOCK_EX);

	if(!empty($merchantCode) && !empty($amount) && !empty($merchantOrderId) && !empty($signature))
	{
		$params = $merchantCode . $amount . $merchantOrderId . $apiKey;
		$calcSignature = md5($params);

		if($signature == $calcSignature)
		{
			//Callback tervalidasi
			//Silahkan rubah status transaksi anda disini
			
			file_put_contents('callback.txt', "* Success $reference - $additionalParam *\r\n\r\n", FILE_APPEND | LOCK_EX);
			
			$info = explode(",",$merchantUserId);
			
			$bids = Bids::find($info[1]);
			$bids->bidstatus = 3;
			$bids->save();
			
			$user = User::find($info[0]);
			$kurs = $user->kurs;
			$user->saldo = $user->saldo - $info[2];
			$user->save();
			
			$payments = Payments::create([
				'tanggal' => date('Y-m-d'),
				'idauctionbids' => $info[1],
				'kurs' => $kurs,
				'amountdp' => $info[2],
				'amount' => ($amount/$kurs),
				'tipebayar' => $paymentMethod,
				'note' => $additionalParam,
				'reference' => $reference,
				'paymentorderid' => $publisherOrderId,
				'iduser' => $info[0],
			]);
			
			

		}
		else
		{
			 file_put_contents('callback.txt', "* Bad Signature *\r\n\r\n", FILE_APPEND | LOCK_EX);

		}
	}
	else
	{
		 file_put_contents('callback.txt', "* Bad Parameter *\r\n\r\n", FILE_APPEND | LOCK_EX);

	}

	  
  }
  
  public function updateref(Request $request)
  {

	$apiKey = config('variables.DapiKey');
	$merchantOrderId = ($request->input('merchantOrderId')!=null) ? $request->input('merchantOrderId') : null; 
	$resultCode = ($request->input('resultCode')!=null) ? $request->input('resultCode') : null; 
	$reference = ($request->input('reference')!=null) ? $request->input('reference') : null; 

	if(!empty($merchantOrderId) && !empty($resultCode) && !empty($merchantOrderId))
	{		
			return redirect()->route('users.deposit.index');
	}
	else
	{
		throw new Exception('Bad Parameter');
	}

	  
  }
  
  
}
