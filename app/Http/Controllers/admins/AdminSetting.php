<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SoulDoit\SetEnv\Env;

class AdminSetting extends Controller
{
  public function index()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.setting_front');
  }
  
  public function saveconf()
  {
	  app('config')->write('variables.tesurl', 'http://domain.com');
  }
  
  public function profile()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.setting_profile');
  }
  
  public function duitku()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.setting_duitku');
  }
  
  public function paypal()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.setting_paypal');
  }
  
  public function email()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.setting_email');
  }
  
  public function bid()
  {
    if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	return view('content.admins.setting_bid');
  }
  
  public function profilesave(Request $request)
  {
	  if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	  
	  
	  
	  
	  app('config')->write('variables.creatorName', $request->creatorName);
	  app('config')->write('variables.creatorUrl', $request->creatorUrl);
	  app('config')->write('variables.templateName', $request->templateName);
	  app('config')->write('variables.templateSuffix', $request->templateSuffix);
	  app('config')->write('variables.templateDescription', $request->templateDescription);
	  app('config')->write('variables.templateKeyword', $request->templateKeyword);
	  app('config')->write('variables.facebookUrl', $request->facebookUrl);
	  app('config')->write('variables.twitterUrl', $request->twitterUrl);
	  app('config')->write('variables.instagramUrl', $request->instagramUrl);
	  app('config')->write('variables.loginName', $request->loginName);
	  app('config')->write('variables.logo', $request->logo);
	  
	  
	  Session::flash('success', 'success update configuration.');
	  
	  return view('content.admins.setting_profile');
  }
  
  public function duitkusave(Request $request)
  {
	  if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	  
	  app('config')->write('variables.DmerchantCode', $request->DmerchantCode);
	  app('config')->write('variables.DapiKey', $request->DapiKey);
	  app('config')->write('variables.DurlMethod', $request->DurlMethod);
	  app('config')->write('variables.DurlInquery', $request->DurlInquery);
	  
	  return view('content.admins.setting_duitku');
  }
  
  public function paypalsave(Request $request)
  {
	  if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	  
	  app('config')->write('variables.PClientID', $request->PClientID);
	  app('config')->write('variables.PSecret', $request->PSecret);
	  
	  return view('content.admins.setting_paypal');
  }
  
  public function emailsave(Request $request)
  {
	  if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	  //app('config')->write('variables.tesurl', 'http://domain.com');
	  $envService = new Env(); 
	  $envService->set("MAIL_HOST", $request->MAIL_HOST);
	  $envService->set("MAIL_PORT", $request->MAIL_PORT);
	  $envService->set("MAIL_USERNAME", $request->MAIL_USERNAME);
	  $envService->set("MAIL_PASSWORD", $request->MAIL_PASSWORD);
	  $envService->set("MAIL_ENCRYPTION", $request->MAIL_ENCRYPTION);
	  $envService->set("MAIL_FROM_ADDRESS", $request->MAIL_FROM_ADDRESS);
	  $envService->set("MAIL_FROM_NAME", $request->MAIL_FROM_NAME);

	  
	  return view('content.admins.setting_front');
  }
  
  public function bidsave(Request $request)
  {
	  if(Auth::User()->admin==0){
		  return redirect()->route('users.pages-user');
	  }
	  
	  app('config')->write('variables.minSaldoBid', $request->minSaldoBid);
	  
	  return view('content.admins.setting_bid');
  }
  
}
