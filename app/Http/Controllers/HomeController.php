<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
	public function index(Request $request)
	{
		$request->user()->authorizeRoles(['admin', 'vendedor']);
		$title = 'Home';
		return view('home', compact('title'));
	}
    
}