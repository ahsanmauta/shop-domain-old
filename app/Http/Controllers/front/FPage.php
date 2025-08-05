<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FPage extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
	return view('content.front-pages.front', ['pageConfigs' => $pageConfigs]);
  }
}
