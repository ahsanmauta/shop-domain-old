<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Auctions;
use App\Models\Deposits;
use App\Models\Payments;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Deposit extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'user'];
	$deposits = Deposits::where('iduser',Auth::user()->id)
						->get();
						
	$jmlDeposit = Deposits::where('iduser',Auth::user()->id)
						->get()
						->sum('amount');
	
	$jmlExpense = Payments::where('iduser',Auth::user()->id)
						->get()
						->sum('amountdp');;
			
    return view('content.users.deposit-list', ['pageConfigs' => $pageConfigs,'deposits' => $deposits,'jmlDeposit' => $jmlDeposit,'jmlExpense' => $jmlExpense]);
  }
  
  public function create()
  {
    $pageConfigs = ['myLayout' => 'user'];
	
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
	
    return view('content.users.deposit-payment', ['pageConfigs' => $pageConfigs,'tipebayar' => $tipebayar]);
  }
  
  public function store(Request $request)
    {
        
		/*if(!isset($request->domain)){
			
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
        ]);*/
		
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
		  
		

		$bidprice = $request->input('invoiceAmount')*Auth::user()->kurs;
		$merchantCode = config('variables.DmerchantCode'); 
		$apiKey = config('variables.DapiKey');
		$paymentAmount = $bidprice;
		$paymentMethod = $request->input('payment-method');
		$merchantOrderId = time() . ''; // dari merchant, unik
		$productDetails = 'Deposit'.date('d-m-Y');
		$email = Auth::user()->email;
		$phoneNumber = Auth::user()->mobile; // nomor telepon pelanggan anda (opsional)
		$additionalParam = $request->input('payment-note');
		$merchantUserInfo = Auth::user()->id;
		$customerVaName = Auth::user()->firstname.' '.Auth::user()->lastname; // tampilan nama pada tampilan konfirmasi bank
		$callbackUrl = url('cbdeposit'); // url untuk callback
		$returnUrl = url('rtdeposit');// url untuk redirect
		$expiryPeriod = 10; // atur waktu kadaluarsa dalam hitungan menit
		$signature = md5($merchantCode . $merchantOrderId . $paymentAmount . $apiKey);

		// Customer Detail
		$firstName = Auth::user()->firstname;
		$lastName = Auth::user()->lastname;

		// Address
		$alamat = Auth::user()->address;
		$city = Auth::user()->city;
		$postalCode = Auth::user()->zipcode;
		$countryCode = Auth::user()->country;

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
			'name' => 'Deposit',
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
		
			header('location: '. $result['paymentUrl']);
			/*echo "paymentUrl :". $result['paymentUrl'] . "<br />";
			echo "merchantCode :". $result['merchantCode'] . "<br />";
			echo "reference :". $result['reference'] . "<br />";
			echo "vaNumber :". ((isset($result['vaNumber']))?$result['vaNumber']:'') . "<br />";
			echo "amount :". ((isset($result['amount']))?$result['amount']:'') . "<br />";
			echo "statusCode :". $result['statusCode'] . "<br />";
			echo "statusMessage :". $result['statusMessage'] . "<br />";*/
		}
		else
		{
			$request = json_decode($request);
			$error_message = "Server Error " . $httpCode ." ". $request->Message;

			return redirect()->back()
			->withInput()
			->withErrors([
				'message' => $error_message,
			]);
		}
		
    }

  public function cbdeposit()
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
	 //file_put_contents('callback.txt', "* Callback *\r\n", FILE_APPEND | LOCK_EX);
	
	
	if(!empty($merchantCode) && !empty($amount) && !empty($merchantOrderId) && !empty($signature))
	{
		$params = $merchantCode . $amount . $merchantOrderId . $apiKey;
		$calcSignature = md5($params);

		if($signature == $calcSignature)
		{
			
			file_put_contents('callback.txt', "* Success $reference - $additionalParam *\r\n\r\n", FILE_APPEND | LOCK_EX);
			
			$user = User::find($merchantUserId);
			$kurs = $user->kurs;
			$user->saldo = $user->saldo + ($amount/$kurs);
			$user->save();
			
			$deposits = Deposits::create([
				'tanggal' => date('Y-m-d'),
				'kurs' => $kurs,
				'amount' => ($amount/$kurs),
				'tipebayar' => $paymentMethod,
				'note' => $additionalParam,
				'reference' => $reference,
				'paymentorderid' => $publisherOrderId,
				'iduser' => $merchantUserId,
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
  
  public function rtdeposit(Request $request)
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
