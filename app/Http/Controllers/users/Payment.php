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

class Payment extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'user'];
	$deposits = Deposits::where('iduser',Auth::user()->id)
						->get();
						
	$payments = Payments::where('iduser',Auth::user()->id)
						->get();
						
	$jmlDeposit = Deposits::where('iduser',Auth::user()->id)
						->get()
						->sum('amount');
	
	$jmlExpense = Payments::where('iduser',Auth::user()->id)
						->get()
						->sum('amountdp');;
			
    return view('content.users.payment-list', ['pageConfigs' => $pageConfigs,'deposits' => $deposits,'jmlDeposit' => $jmlDeposit,'jmlExpense' => $jmlExpense,'payments' => $payments]);
  }
  
}