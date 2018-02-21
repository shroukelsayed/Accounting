<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
	public function __construct()
	{
		// $this->middleware('auth');
		$this->middleware('auth',['only' =>['receipts']]);
	    
	}

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// $users = User::orderBy('id', 'desc')->paginate(10);

		return view('welcome');
	}

	 /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function accountingTree()
	{
		// $users = User::orderBy('id', 'desc')->paginate(10);

		return view('welcome');
	}

	 /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function allocation()
	{
		// $users = User::orderBy('id', 'desc')->paginate(10);

		return view('welcome');
	}

	 /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function custodyAdvances()
	{
		// $users = User::orderBy('id', 'desc')->paginate(10);

		return view('welcome');
	}

	 /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function treasury()
	{
		// $users = User::orderBy('id', 'desc')->paginate(10);

		return view('welcome');
	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function receipts()
	{
		// $users = User::orderBy('id', 'desc')->paginate(10);

		return view('donation-receipt');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function cashReceipt()
	{
		// $users = User::orderBy('id', 'desc')->paginate(10);

		return view('cash-receipt');
	}
	


}
