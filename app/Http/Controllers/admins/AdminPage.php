<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPage extends Controller
{
  public function index()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.pages.pages-home');
  }
}
