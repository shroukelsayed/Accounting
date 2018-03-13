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
	public function receipts($id = null)
	{
		
		if($id){
			$receipt = DonationReceipt::findOrFail($id);
		}

		$projects = Project::lists('name','id');

		return view('donation-receipt', compact('projects','receipt'));
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function saveReceipt(Request $request,$id = null)
	{
		// var_dump($request->all());die();
		// var_dump($id);die();
		if(is_null($id)){
			$receipt = new DonationReceipt();
			$receipt->is_approved = false;
		}
		else{
			$receipt = DonationReceipt::findOrFail($id);
			if(!is_null($request->input('is_approved')) && $request->input('is_approved') == '1'){
				$receipt->is_approved = true;
				$receipt->collecting_type = $request->input('collecting_type');
			}

		}

		$receipt->cash = $request->input('receipt_type') == '1' ? true : false;
		if($request->input('receipt_type') == '1'){
			$validator = Validator::make($request->all(), [
            	'donator_name' => 'required|max:255',
	            'donator_address' => 'required',
	            'amount_alpha' => 'required',
	            'notes' => 'required',
	            'type' => 'required',
	            'delivery_date' => 'required',
	            'donator_phone' => 'required|numeric',
	            'project_id' => 'required',
	            'receipt_writter_id' => 'required',
	            'receipt_delegate_id' => 'required',
	            'receipt_notebook' => 'required',
	            'receipt_for_month' => 'required',
	        ]);
	        if($validator->fails()) {
		        return Redirect::back()
		            ->withErrors($validator)
		            ->WithInput();
		    }
		    $receipt->cheque_number = 0;
			$receipt->cheque_bank = "";
			$receipt->cheque_date = $request->input('delivery_date');
			$receipt->alpha_amount = $request->input('amount_alpha');
		}else{
			$validator = Validator::make($request->all(), [
	            'donator_name' => 'required|max:255',
	            'donator_address' => 'required',
	            'cheque_number' => 'required',
	            'cheque_bank' => 'required',
	            'cheque_date' => 'required',
	            'notes' => 'required',
	            'type' => 'required',
	            'delivery_date' => 'required',
	            'donator_phone' => 'required|numeric',
	            'project_id' => 'required',
	            'receipt_writter_id' => 'required',
	            'receipt_delegate_id' => 'required',
	            'receipt_notebook' => 'required',
	            'receipt_for_month' => 'required',
	        ]);
	        if($validator->fails()) {
		        return Redirect::back()
		            ->withErrors($validator)
		            ->WithInput();
		    }

			$receipt->cheque_number = $request->input('cheque_number');
			$receipt->cheque_bank = $request->input('cheque_bank');
			$receipt->cheque_date = $request->input('cheque_date');
		}

		$receipt->alpha_amount = $request->input('amount_alpha');
		$receipt->amount = $request->input('amount_alpha');
		$receipt->notes = $request->input('notes');
		$receipt->type = $request->input('type');
		$receipt->receipt_date = $request->input('delivery_date');
		$receipt->donator_name = $request->input('donator_name');
		$receipt->donator_address = $request->input('donator_address');
		$receipt->donator_mobile = $request->input('donator_phone');
		$receipt->project_id = $request->input('project_id');
		$receipt->receipt_writter_id = $request->input('receipt_writter_id');
		$receipt->receipt_delegate_id = $request->input('receipt_delegate_id');
		$receipt->receipt_notebook =$request->input('receipt_notebook') ;
		$receipt->receipt_for_month = $request->input('receipt_for_month');
		// $receipt->donation_section = $request->input('');


		$receipt->save();

		return redirect()->action('IndexController@receipts');

	}

	// function seacrh for existing person in system to add new case for him --> by shrouk
	public function search(Request $request)
	{
		// var_dump($request->all());die;
		$receipts = DonationReceipt::findOrFail($request->input("receipt_id"));

		// if ($request->input("action")=="person_name")
		// {	
		// 	$name=PersonInfo::where('nationalid','LIKE', '%' . $request->input("person_name"). '%')->orWhere('name','LIKE', '%' . $request->input("person_name"). '%')->get();
	
			return $receipts;
		// }
	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function cashReceipt(Request $request)
	{
		// var_dump($request->all());die;
		// $users = User::orderBy('id', 'desc')->paginate(10);

		return view('cash-receipt');
	}
	


}
