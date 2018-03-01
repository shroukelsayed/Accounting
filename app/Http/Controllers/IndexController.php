<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Validator;

use App\Http\Requests;
use App\Project;
use App\DonationReceipt;
use Illuminate\Support\Facades\Redirect;

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
		$receipts = DonationReceipt::all();

		return view('receipts-index',compact('receipts'));
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
				 
		$projects = Project::lists('name','id');
			// var_dump($projects);die;
		return view('donation-receipt', compact('projects'));
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function saveReceipt(Request $request)
	{
		// var_dump($request->all());die();
		 $validator = Validator::make($request->all(), [
            'donator_name' => 'bail|required|max:255',
            'donator_address' => 'required',
        ]);
// var_dump($validator->errors());die;
        if ($validator->fails()) {
            return  redirect('receipts')->withErrors($validator)->withInput();
        }


		$receipt = new DonationReceipt();


		$receipt->cash = $request->input('receipt_type') == '1' ? true : false;
		if($request->input('receipt_type') == '1'){
			$receipt->alpha_amount = $request->input('amount_alpha');
		}else{
			$receipt->cheque_number = $request->input('cheque_number');
			$receipt->cheque_bank = $request->input('cheque_bank');
			$receipt->cheque_date = $request->input('cheque_date');
		}

		$receipt->amount = $request->input('amount_alpha');
		$receipt->notes = $request->input('notes');
		$receipt->type = $request->input('type');
		$receipt->receipt_date = $request->input('delivery_date');

		// $receipt->for_account = $request->input('');
		$receipt->is_approved = false;

		$receipt->donator_name = $request->input('donator_name');
		$receipt->donator_address = $request->input('donator_address');
		$receipt->donator_mobile = $request->input('donator_phone');

		$receipt->project_id = $request->input('project_id');
		$receipt->receipt_writter_id = $request->input('receipt_writter_id');
		$receipt->receipt_delegate_id = $request->input('receipt_delegate_id');
		$receipt->receipt_notebook =$request->input('receipt_notebook') ;
		$receipt->receipt_for_month = $request->input('receipt_for_month');
		// $receipt->donation_section = $request->input('');
		// $receipt->collecting_type = $request->input('');


		$receipt->save();

		return redirect()->action('IndexController@receipts');

		// $projects = Project::lists('name','id');
		// 	// var_dump($projects);die;
		// return view('donation-receipt', compact('projects'));
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
