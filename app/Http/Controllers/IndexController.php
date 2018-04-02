<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;
use DB;
use Validator;
use Auth;
use App;

use App\Http\Requests;
use App\Project;
use App\DonationReceipt;
use App\Receipt;
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
		$receipts = DonationReceipt::orderBy('id', 'asc')->paginate(10);

		return view('receipts-index',compact('receipts'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function allCashReceipts()
	{
		$receipts = Receipt::all();

		return view('all-cash-receipts',compact('receipts'));
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
			$last_id = ($last_receipt)? ($last_receipt->id +1) : 1;
			
			if($last_receipt){
				$receiptsCount =  DB::select("SELECT count(id) as count FROM donation_receipts WHERE  receipt_notebook = ". $last_receipt->receipt_notebook);
				$datetime = new DateTime($last_receipt->receipt_date);
				if(($receiptsCount[0]->count >= 50) || (date('m') > $datetime->format('m')))
					$notebook = $last_receipt->receipt_notebook + 1 ;
				else
					$notebook = $last_receipt->receipt_notebook;	
			}else
				$notebook = 1;
			
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

		if(is_null($id)){
			$receipt = new DonationReceipt();
			$receipt->is_approved = false;
			$receipt->collecting_type = "";
			$receipt->receipt_id = 0;
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
		if($request->input('cash') != '2'){
			if($query != '')
				$query .= ' and ';
			else
				$query .= $where;
			$query .= "cash = " .  (int)$request->input('cash');
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
		$ids = null;
		$last_receipt = Receipt::orderby('id', 'desc')->first();
		$last_id = ($last_receipt)? $last_receipt->id +1 : 1;

		if($request->input('checked') !== null && is_array($request->input('checked'))){
			$ids = implode(',',$request->input('checked'));
			$receipts = DonationReceipt::whereIn('id',$request->input('checked'))->get();
			$last_receipt = Receipt::orderby('id', 'desc')->first();
			$last_id = ($last_receipt)? $last_receipt->id +1 : 1;

			$amount = 0;
			$receipt_type = $receipts[0]->cash;
			$projects_amount = array();
			foreach ($receipts as $key => $receipt) {
				$amount += $receipt->amount;
				if(isset($projects_amount[$receipt->project->name]))
					$projects_amount[$receipt->project->name] += $receipt->amount;
				else
					$projects_amount[$receipt->project->name] = $receipt->amount;
			}
			return view('cash-receipt',compact('amount','receipt_type','last_id','projects_amount','ids'));
		}
		
		return view('cash-receipt',compact('ids','last_id'));
	}


	public function saveCash(Request $request)
	{
		// var_dump($request->all());die;
		$ids =  $request->input('ids');
		$receipt_type = $request->input('receipt_type');
		$last_id =  $request->input('last_id');
		$amount =  $request->input('amount');
		$receipts = DonationReceipt::whereIn('id',explode(',', $request->input('ids')))->get();
		$projects_amount = array();
		foreach ($receipts as $key => $receipt) {
			if(isset($projects_amount[$receipt->project->name]))
				$projects_amount[$receipt->project->name] += $receipt->amount;
			else
				$projects_amount[$receipt->project->name] = $receipt->amount;
		}


		if($request->input('receipt_type') == '1'){
			$validator = Validator::make($request->all(), [
            	'delivered_by' => 'required|max:255',
	            'notes' => 'required',
	        ]);
	        if($validator->fails()) {
		        return view('cash-receipt')->withErrors($validator)->with(compact('amount','receipt_type','last_id','projects_amount','ids'));
		    }
		}else{
			$validator = Validator::make($request->all(), [
            	'delivered_by' => 'required|max:255',
	            'notes' => 'required',
	            'cheque_number' => 'required',
	            'cheque_bank' => 'required',
	            'cheque_date' => 'required',
	        ]);
	        if($validator->fails()) {
		        return view('cash-receipt')->withErrors($validator)->with(compact('amount','receipt_type','last_id','projects_amount','ids'));
		    }
		}

		$receipt = new Receipt();
		$ids = explode(',', $request->input('ids'));

		if($request->input('receipt_type') != '1'){
		    $receipt->cheque_number = $request->input('cheque_number');
			$receipt->cheque_bank = $request->input('cheque_bank');
		    $receipt->cheque_date = $request->input('cheque_date');
		}

		$receipt->cheque_number = 0;
		$receipt->for_account = "";
		$receipt->cheque_bank = "";
	    $receipt->cheque_date = $request->input('delivery_date');
	    $receipt->user_id = Auth::user()->id;


		$receipt->receipt_date = $request->input('delivery_date');
		$receipt->delivered_by = $request->input('delivered_by');
		$receipt->notes = $request->input('notes');
		$receipt->type = 0;
		$receipt->cash = $request->input('receipt_type');
		$receipt->amount = $request->input('amount');
		$receipt->alpha_amount = $request->input('amount_alpha');
		$receipt->save();
		$donation_receipts = DonationReceipt::whereIn('id',$ids)->get();

		foreach ($donation_receipts as $key => $donation_receipt) {
			$donation_receipt->receipt_id = $receipt->id;
			$donation_receipt->save();
		}

		return redirect()->action('IndexController@index');	
	}
	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function licenseReceipts($id = null)
	{
		
		if($id){
			$receipt = DonationReceipt::findOrFail($id);
			$last_id = $receipt->id;
			$notebook = $receipt->receipt_notebook;
		}else{
			$last_receipt = DonationReceipt::orderby('id', 'desc')->first();
			$last_id = ($last_receipt)? ($last_receipt->id +1) : 1;
			
			if($last_receipt){
				$receiptsCount =  DB::select("SELECT count(id) as count FROM donation_receipts WHERE  receipt_notebook = ". $last_receipt->receipt_notebook);
				$datetime = new DateTime($last_receipt->receipt_date);
				if(($receiptsCount[0]->count >= 50) || (date('m') > $datetime->format('m')))
					$notebook = $last_receipt->receipt_notebook + 1 ;
				else
					$notebook = $last_receipt->receipt_notebook;	
			}else
				$notebook = 1;
		}

		$projects = Project::lists('name','id');

		return view('donation-receipt-license', compact('projects','receipt','last_id','notebook'));
	}


	public function convertNumber(Request $request)
	{
		$number = $request->input('number');
		$outputf  = "";
		if(strpos((string) $number, '.')){
	    	list($integer, $fraction) = explode(".", (string) $number);
	    	if ($fraction > 0)
		    {
		        $outputf .=  " و" . $fraction;
		        // for ($i = 0; $i < strlen($fraction); $i++)
		        // {
		        //     $outputf .= " " . $this->convertDigit($fraction{$i});
		        // }
		    }
		}else{
            $integer = (string)$number;
		}

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
	        $output .= " " . trans('validation.zero');
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
                	 if((11 - $z) == 1 ){

	                    if($groups2[$z] == " واحد")
                            $output .= "ألف";
                        elseif ($groups2[$z] == " اثنين")
                            $output .= "ألفان";
                        elseif (strlen($groups2[$z]) > 11) 
                            $output .= $groups2[$z] . " ألف";
                        else
                        	$output .=  $groups2[$z] . $this->convertGroup(11 - $z);
                   
                    }else                    	
                      	$output .= $groups2[$z] . $this->convertGroup(11 - $z);


                    $output .= (
                            $z < 11
                            && !array_search('', array_slice($groups2, $z + 1, -1))
                            && $groups2[11] != ''
                            && $groups[11]{0} == '0'
                                ? " و "
                                : " , "
                        );
                }
	        }

	        $output = rtrim($output, ", ");
	    }

	    return $output . " جنيه" . $outputf;
	}

	function convertGroup($index){
	    switch ($index)
	    {
	        case 11:
	            return " " . trans('validation.decillion');
	        case 10:
	            return " " . trans('validation.nonillion');
	        case 9:
	            return " " . trans('validation.octillion');
	        case 8:
	            return " " . trans('validation.septillion');
	        case 7:
	            return " " . trans('validation.sextillion');
	        case 6:
	            return " " . trans('validation.quintrillion');
	        case 5:
	            return " " . trans('validation.quadrillion');
	        case 4:
	            return " " . trans('validation.trillion');
	        case 3:
	            return " " . trans('validation.billion');
	        case 2:
	            return " " . trans('validation.million');
	        case 1:
	            return " " . trans('validation.thousand');
	        case 0:
	            return "";
	    }
	}

	function convertThreeDigit($digit1, $digit2, $digit3){
	    $buffer = "";

	    if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
	    {
	        return "";
	    }

	    if ($digit1 != "0")
	    {
	    	if($digit1 == "2" && App::isLocale('ar')){
	    		$buffer = " مائتين";
	    	}
	    	elseif($digit1 == "1" && App::isLocale('ar')){
	    		$buffer = " مائة";
	    	}
	    	else
	        	$buffer .= $this->convertDigit($digit1) . " " . trans('validation.hundred');
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

	function convertTwoDigit($digit1, $digit2){
	    if ($digit2 == "0")
	    {
	        switch ($digit1)
	        {
	            case "1":
	                return " " . trans('validation.ten');
	            case "2":
	                return " " . trans('validation.twenty');
	            case "3":
	                return " " . trans('validation.thirty');
	            case "4":
	                return " " . trans('validation.forty');
	            case "5":
	                return " " . trans('validation.fifty');
	            case "6":
	                return " " . trans('validation.sixty');
	            case "7":
	                return " " . trans('validation.seventy');
	            case "8":
	                return " " . trans('validation.eighty');
	            case "9":
	                return " " . trans('validation.ninety');
	        }
	    } else if ($digit1 == "1")
	    {
	        switch ($digit2)
	        {
	            case "1":
	                return  " " . trans('validation.eleven');
	            case "2":
	                return  " " . trans('validation.twelve');
	            case "3":
	                return  " " . trans('validation.thirteen');
	            case "4":
	                return  " " . trans('validation.fourteen');
	            case "5":
	                return  " " . trans('validation.fifteen');
	            case "6":
	                return  " " . trans('validation.sixteen');
	            case "7":
	                return  " " . trans('validation.seventeen');
	            case "8":
	                return  " " . trans('validation.eighteen');
	            case "9":
	                return  " " . trans('validation.nineteen');
	        }
	    } else
	    {
	        $temp = $this->convertDigit($digit2);
	        switch ($digit1)
	        {
	            case "2":
	                return $temp . " " . trans('validation.twenty');
	            case "3":
	                return $temp . " " . trans('validation.thirty');
	            case "4":
	                return $temp . " " . trans('validation.forty');
	            case "5":
	                return $temp . " " . trans('validation.fifty');
	            case "6":
	                return $temp . " " . trans('validation.sixty');
	            case "7":
	                return $temp . " " . trans('validation.seventy');
	            case "8":
	                return $temp . " " . trans('validation.eighty');
	            case "9":
	                return $temp . " " . trans('validation.ninety');
	        }
	    }
	}

	function convertDigit($digit){
	    switch ($digit)
	    {
	        case "0":
	            return " " . trans('validation.zero');
	        case "1":
	            return " " . trans('validation.one');
	        case "2":
	            return " " . trans('validation.two');
	        case "3":
	            return " " . trans('validation.three');
	        case "4":
	            return " " . trans('validation.four');
	        case "5":
	            return " " . trans('validation.five');
	        case "6":
	            return " " . trans('validation.six');
	        case "7":
	            return " " . trans('validation.seven');
	        case "8":
	            return " " . trans('validation.eight');
	        case "9":
	            return " " . trans('validation.nine');
	    }
	}

}
