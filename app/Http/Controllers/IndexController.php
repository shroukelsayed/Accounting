<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Validator;
use Auth;

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
			$last_id = $receipt->id;
			$notebook = $receipt->receipt_notebook;
		}else{
			$last_receipt = DonationReceipt::orderby('id', 'desc')->first();
			$last_id = $last_receipt->id + 1 ;
			$notebook = $last_receipt->receipt_notebook;
		}

		$projects = Project::lists('name','id');

		return view('donation-receipt', compact('projects','receipt','last_id','notebook'));
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
			$receipt->collecting_type = "";
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
	            'amount' => 'required',
	            'notes' => 'required',
	            'type' => 'required',
	            'delivery_date' => 'required',
	            'donator_phone' => 'required|numeric',
	            'project_id' => 'required',
	            'receipt_writter_id' => 'required',
	            'receipt_delegate_id' => 'required',
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
	            'amount' => 'required',
	            'notes' => 'required',
	            'type' => 'required',
	            'delivery_date' => 'required',
	            'donator_phone' => 'required|numeric',
	            'project_id' => 'required',
	            'receipt_writter_id' => 'required',
	            'receipt_delegate_id' => 'required',
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
		$receipt->amount = $request->input('amount');
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
		$receipt->donation_section = 1;
		$receipt->user_id = Auth::user()->id;


		$receipt->save();

		return redirect()->action('IndexController@receipts');

	}

	// function seacrh for existing receipt in system 
	public function search(Request $request)
	{
		

		// var_dump($request->all());die;
		$where = " where ";
		$query = "";
		if($request->input('receipt_id') != ''){
			$query = $where . 'id = '.$request->input('receipt_id');
		}
		if($request->input('donator_address') != ''){
			if($query != '')
				$query .= ' and ';
			else
				$query .= $where;
			$query .= "donator_address LIKE  '%" .$request->input('donator_address') ."%'";
		}
		if($request->input('donator_name') != ''){
			if($query != '')
				$query .= ' and ';
			else
				$query .= $where;
			$query .= "donator_name LIKE  '%" .$request->input('donator_name') ."%'";
		}
		if($request->input('receipt_date') != ''){
			if($query != '')
				$query .= ' and ';
			else
				$query .= $where;
			$query .= "DATE(receipt_date) = '" .$request->input('receipt_date')."'";
		}
		if($request->input('amount') != ''){
			if($query != '')
				$query .= ' and ';
			else
				$query .= $where;
			$query .= "amount = " .$request->input('amount');
		}
		if($request->input('type') != '0'){
			if($query != '')
				$query .= ' and ';
			else
				$query .= $where;
			$query .= "type = " .$request->input('type');
		}
		if($request->input('cash') != '0'){
			if($query != '')
				$query .= ' and ';
			else
				$query .= $where;
			$query .= "cash = " .  $request->input('cash');
		}

		$receipts =  DB::select("SELECT * FROM donation_receipts ". $query);

		return view('table',compact('receipts'))->render();

	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function cashReceipt(Request $request)
	{
		// var_dump($request->all());die;
		$receipts = DonationReceipt::whereIn('id',array(2,3,4))->get();
		$amount = 0;
		foreach ($receipts as $key => $receipt) {
			$amount += $receipt->amount;
			var_dump($receipt->id);
		}
		die;
		// var_dump($receipts);die;

		// $users = User::orderBy('id', 'desc')->paginate(10);

		return view('cash-receipt');
	}
	

	public function convertNumber(Request $request)
	{
		$number = $request->input('number');

	    list($integer, $fraction) = explode(".", (string) $number);

	    $output = "";

	    if ($integer{0} == "-")
	    {
	        $output = "negative ";
	        $integer    = ltrim($integer, "-");
	    }
	    else if ($integer{0} == "+")
	    {
	        $output = "positive ";
	        $integer    = ltrim($integer, "+");
	    }

	    if ($integer{0} == "0")
	    {
	        $output .= "صفر";
	    }
	    else
	    {
	        $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
	        $group   = rtrim(chunk_split($integer, 3, " "), " ");
	        $groups  = explode(" ", $group);

	        $groups2 = array();
	        foreach ($groups as $g)
	        {
	            $groups2[] = $this->convertThreeDigit($g{0}, $g{1}, $g{2});
	        }

	        for ($z = 0; $z < count($groups2); $z++)
	        {
	            if ($groups2[$z] != "")
	            {
	                $output .= $groups2[$z] . $this->convertGroup(11 - $z) . (
	                        $z < 11
	                        && !array_search('', array_slice($groups2, $z + 1, -1))
	                        && $groups2[11] != ''
	                        && $groups[11]{0} == '0'
	                            ? " و "
	                            : ", "
	                    );
	            }
	        }

	        $output = rtrim($output, ", ");
	    }

	    if ($fraction > 0)
	    {
	        $output .= " ,";
	        for ($i = 0; $i < strlen($fraction); $i++)
	        {
	            $output .= " " . $this->convertDigit($fraction{$i});
	        }
	    }

	    return $output;
	}

	function convertGroup($index)
	{
	    switch ($index)
	    {
	        case 11:
	            return " decillion";
	        case 10:
	            return " nonillion";
	        case 9:
	            return " octillion";
	        case 8:
	            return " septillion";
	        case 7:
	            return " sextillion";
	        case 6:
	            return " quintrillion";
	        case 5:
	            return " quadrillion";
	        case 4:
	            return " تريليون";
	        case 3:
	            return " [ليون]";
	        case 2:
	            return " مليون";
	        case 1:
	            return " ألف";
	        case 0:
	            return "";
	    }
	}

	function convertThreeDigit($digit1, $digit2, $digit3)
	{
	    $buffer = "";

	    if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
	    {
	        return "";
	    }

	    if ($digit1 != "0")
	    {
	    	// var_dump($digit1);die;
	    	if($digit1 == "2")
	    		$buffer = "مائتين";
	    	else
	        	$buffer .= $this->convertDigit($digit1) . " مائة";
	        if ($digit2 != "0" || $digit3 != "0")
	        {
	            $buffer .= " و ";
	        }
	    }

	    if ($digit2 != "0")
	    {
	        $buffer .= $this->convertTwoDigit($digit2, $digit3);
	    }
	    else if ($digit3 != "0")
	    {
	        $buffer .= $this->convertDigit($digit3);
	    }

	    return $buffer;
	}

	function convertTwoDigit($digit1, $digit2)
	{
	    if ($digit2 == "0")
	    {
	        switch ($digit1)
	        {
	            case "1":
	                return "عشرة";
	            case "2":
	                return "عشرون";
	            case "3":
	                return "ثلاثون";
	            case "4":
	                return "أربعون";
	            case "5":
	                return "خمسون";
	            case "6":
	                return "ستون";
	            case "7":
	                return "سبعون";
	            case "8":
	                return "ثمانون";
	            case "9":
	                return "تسعون";
	        }
	    } else if ($digit1 == "1")
	    {
	        switch ($digit2)
	        {
	            case "1":
	                return "إحدى عشر";
	            case "2":
	                return "إثنى عشر";
	            case "3":
	                return "ثلاث عشر";
	            case "4":
	                return "أربع عشر";
	            case "5":
	                return "خمس عشر";
	            case "6":
	                return "ست عشر";
	            case "7":
	                return "سبع عشر";
	            case "8":
	                return "ثمان عشر";
	            case "9":
	                return "تسع عشر ";
	        }
	    } else
	    {
	        $temp = $this->convertDigit($digit2);
	        switch ($digit1)
	        {
	            case "2":
	                return "عشرون-$temp";
	            case "3":
	                return "ثلاثون-$temp";
	            case "4":
	                return "أربعون-$temp";
	            case "5":
	                return "خمسون-$temp";
	            case "6":
	                return "ستون-$temp";
	            case "7":
	                return "سبعون-$temp";
	            case "8":
	                return "ثمانون-$temp";
	            case "9":
	                return "تسعون-$temp";
	        }
	    }
	}

	function convertDigit($digit)
	{
	    switch ($digit)
	    {
	        case "0":
	            return "صفر";
	        case "1":
	            return "واحد";
	        case "2":
	            return "اثنين";
	        case "3":
	            return "ثلاث";
	        case "4":
	            return "أربع";
	        case "5":
	            return "خمس";
	        case "6":
	            return "ست";
	        case "7":
	            return "سبع";
	        case "8":
	            return "ثمان";
	        case "9":
	            return "تسع";
	    }
	}

}
