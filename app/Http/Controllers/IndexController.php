<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;
use DB;
use Validator;
use Auth;
use App;
use Input;

use App\Http\Requests;
use App\Project;
use App\DonationReceipt;
use App\LicenseReceipt;
use App\Receipt;

use App\Workers;
use App\AccountingTreeLevelTwo;


use App\CurrentAssets;
use App\Banks;
use App\BankAccounts;
use App\BankAccountItems;
use App\Treasury;
use App\TreasuryCurrencies;
use App\Currency;
use App\AdvancedExpenses;
use App\ExpensesItems;
use App\DepositsWithOthers;
use App\DepositsWithOtherItems;
use App\CustodyAndAdvances;
use App\ReceivableCheques;
use App\VariousDebitors;
use App\Fawry;
use App\FawryItems;
use App\FawryBanks;
use App\Stores;
use App\Sms;
use App\AccuredRevenues;
use App\OtherDebitBalances;
use App\CibMachine;

use App\CurrentLiabilities;
use App\AccuredExpenses;
use App\AmountsUnderAdjustments;
use App\Creditors;
use App\PayableCheques;
use App\PenalitiesFunds;
use App\FriendshipFunds;
use App\SocialInsurances;
use App\SocialInsuranceItems;
use App\Taxes;
use App\Suppliers;
use App\SuppliersCreditors;

use App\LevelThreeOperationExpenses;
use App\LevelThreeGeneralExpenses;
use App\LevelFourOperationExpenses;
use App\LevelFourGeneralExpenses;
use App\OperationExpenseItems;
use App\GeneralExpenseItems;

use App\AdvancedExpenseExpensesItems; 
use App\AccuredExpenseItems;
use App\FawryItemBanks;
use App\AccountItems;
use App\StoreItems;
use App\CustodyAndAdvanceWorkers;
use App\AccuredRevenuesItems;
use App\AccuredItems;
use App\PenalitiesFundWorkers;
use App\FriendshipFundWorkers;
use App\InsuranceItems;

use App\LevelThreeRevenues;
use App\LevelFourRevenues;
use App\NotebookLicenses;
use App\Coupons;
use App\RevenueCoupons;
use App\RBankAccounts;
use App\RBenefitItems;
use App\RFawryItems;
use App\RevenueFawries;
use App\RevenueBanks;
use App\RevenueBankAccounts;
use App\RevenueBenefits;
use App\RevenueBenefitItems;
use App\RevenueFawryItems;
use App\RevenueMalls;
use App\RevenueSms;

use App\AccountSheet;




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
		$licenseReceipts = LicenseReceipt::all();

		return view('receipts-index',compact('receipts','licenseReceipts'));
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
		$workers = Workers::lists('title','id');

		return view('donation-receipt', compact('projects','receipt','last_id','notebook','workers'));
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function licenseReceipts($id = null)
	{
		if($id){
			$receipt = LicenseReceipt::findOrFail($id);
			$last_id = $receipt->id;
			$notebook = $receipt->receipt_notebook;
		}else{
			$last_receipt = LicenseReceipt::orderby('id', 'desc')->first();
			$last_id = ($last_receipt)? ($last_receipt->id +1) : 1;
			
			if($last_receipt){
				$receiptsCount =  DB::select("SELECT count(id) as count FROM license_receipts WHERE  receipt_notebook = ". $last_receipt->receipt_notebook);
				$datetime = new DateTime($last_receipt->receipt_date);
				if(($receiptsCount[0]->count >= 50) || (date('m') > $datetime->format('m')))
					$notebook = $last_receipt->receipt_notebook + 1 ;
				else
					$notebook = $last_receipt->receipt_notebook;	
			}else
				$notebook = 1;
		}
		$ourPeriod = '';
		var_dump(date('d-m-Y',strtotime('+1 years')));die;
		// mktime(0, 0, 0, date("m"),   date("d"),date("Y")+1)/
		$projects = Project::lists('name','id');
		$workers = Workers::lists('title','id');

		return view('donation-receipt-license', compact('projects','receipt','last_id','notebook','workers'));
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function saveReceipt(Request $request,$id = null)
	{
		// var_dump($request->all());die();
		$validationArray = array();

		if(!is_null($request->input('license')) and $request->input('license')){
			if(is_null($id)){
				$receipt = new LicenseReceipt();
				$receipt->is_approved = false;
				$receipt->collecting_type = "";
				$receipt->receipt_id = 0;
			}else{
				$receipt = LicenseReceipt::findOrFail($id);
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
		            'type' => 'required',
		            'delivery_date' => 'required',
		            'donator_phone' => 'required|numeric',
		            'project_id' => 'required',
		            'receipt_delegate_id' => 'required'
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
		            'type' => 'required',
		            'delivery_date' => 'required',
		            'donator_phone' => 'required|numeric',
		            'project_id' => 'required',
		            'receipt_delegate_id' => 'required'
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

		}else{
			if(is_null($id)){
				$receipt = new DonationReceipt();
				$receipt->is_approved = false;
				$receipt->collecting_type = "";
				$receipt->receipt_id = 0;

			}else{
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
		}
		
		// var_dump($receipt->cash);die;

		$receipt->alpha_amount = $request->input('amount_alpha');
		$receipt->amount = str_replace(',', '',$request->input('amount'));
		$receipt->type = $request->input('type');
		$receipt->receipt_date = $request->input('delivery_date');
		$receipt->donator_name = $request->input('donator_name');
		$receipt->donator_address = $request->input('donator_address');
		$receipt->donator_mobile = $request->input('donator_phone');
		$receipt->project_id = $request->input('project_id');
		$receipt->receipt_delegate_id = $request->input('receipt_delegate_id');
		$receipt->receipt_notebook =$request->input('receipt_notebook') ;
		$receipt->donation_section = 1;
		$receipt->user_id = Auth::user()->id;

		if(is_null($request->input('license'))){
			$receipt->notes = $request->input('notes');
			$receipt->receipt_writter_id = $request->input('receipt_writter_id');
			$receipt->receipt_for_month = $request->input('receipt_for_month');	
		}
		$receipt->save();
		// var_dump("jkj");die;
		return redirect()->action('IndexController@receipts');

	}

	// function seacrh for existing receipt in system 
	public function search(Request $request)
	{
		$where = " where ";
		$query = "";
		$query1 = "";
		$query2 = "";
		$project;
		
		if($request->input('donator_address') != ''){
			if($query != '')
				$query .= ' and ';
			else
				$query .= $where;
			$query .= "donator_address LIKE  '%" .$request->input('donator_address') ."%'";
		}
		if($request->input('donator_mobile') != ''){
			if($query != '')
				$query .= ' and ';
			else
				$query .= $where;
			$query .= "donator_mobile LIKE  '%" .$request->input('donator_mobile') ."%'";
		}
		if($request->input('donator_name') != ''){
			if($query != '')
				$query .= ' and ';
			else
				$query .= $where;
			$query .= "donator_name LIKE  '%" .$request->input('donator_name') ."%'";
		}
		if($request->input('project_name') != ''){
			$project = DB::select("SELECT * FROM projects WHERE name LIKE '%" . $request->input('project_name') ."%'  ");

			if(!empty($project)){
				$ids_array = '(';
				$count = count($project);
				for ($i=0; $i < $count ; $i++) { 
					$ids_array .= $project[$i]->id;
					if($i+1 < $count)
						$ids_array .= ',';
				}
				$ids_array .= ')';

				if($query != '')
					$query .= ' and ';
				else
					$query .= $where;
				$query .= "project_id in " .$ids_array;
			}else{
				if($query != '')
					$query .= ' and ';
				else
					$query .= $where;
				$query .= "project_id is null ";
			}
			
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
			
		if($query != '')
			$query1 = " and P.id = DR.project_id ";
		else
			$query1 = " where P.id = DR.project_id ";

		if($request->input('receipt_id') != '')
			$query2 = "and DR.id = " . $request->input('receipt_id');

		$receipts =  DB::select("SELECT DR.* , P.name FROM donation_receipts AS DR ,projects AS P". $query . $query1 . $query2);

		if($query != '')
			$query1 = " and P.id = LR.project_id ";
		else
			$query1 = " where P.id = LR.project_id ";

		if($request->input('receipt_id') != '')
			$query2 = "and LR.id = " . $request->input('receipt_id');

		$licenseReceipts =  DB::select("SELECT LR.* , P.name FROM license_receipts  AS LR ,projects AS P". $query . $query1 . $query2);
		// var_dump($receipts);die;
		return view('table',compact('receipts','licenseReceipts'))->render();
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

		// return redirect()->action('IndexController@index');	
		return redirect()->action('IndexController@accountSheet', ['cash_id' => $receipt->id,'ids'=>$ids]);

	}
	

	public function convertNumber(Request $request)
	{
		$number = str_replace(',','',$request->input('number'));
		$outputf  = "";
		if(strpos((string) $number, '.')){
	    	list($integer, $fraction) = explode(".", (string) $number);
	    	if ($fraction > 0)
		    {
		        $outputf .=  " و" . $fraction . " / 100 ";
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

	    return $output . $outputf . " جنيها مصريا فقط لا غير " ;
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
	                return $temp . " و " . trans('validation.twenty');
	            case "3":
	                return $temp . " و " . trans('validation.thirty');
	            case "4":
	                return $temp . " و " . trans('validation.forty');
	            case "5":
	                return $temp . " و " . trans('validation.fifty');
	            case "6":
	                return $temp . " و " . trans('validation.sixty');
	            case "7":
	                return $temp . " و " . trans('validation.seventy');
	            case "8":
	                return $temp . " و " . trans('validation.eighty');
	            case "9":
	                return $temp . " و " . trans('validation.ninety');
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

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function accountSheet(Request $request)
	{
		$workers = Workers::lists('title','id');
        $levels = AccountingTreeLevelTwo::lists('title','code');
       	
		// $ids = null;
		$last_sheet = AccountSheet::orderby('id', 'desc')->first();
		$last_id = ($last_sheet)? $last_sheet->id +1  . '/' . getdate()['mon'] : 1  . '/' . getdate()['mon'];
		// var_dump($request->all());die;
		$ids =  $request->input('ids');
		$receipts = DonationReceipt::whereIn('id',$ids)->get();
		$projects_amount = array();
		foreach ($receipts as $key => $receipt) {
			if(isset($projects_amount[$receipt->project->name]))
				$projects_amount[$receipt->project->name] += $receipt->amount;
			else
				$projects_amount[$receipt->project->name] = $receipt->amount;
		}


		$cashReceipt = Receipt::find($request->input('cash_id'));
       	// var_dump($projects_amount,$last_id,$cashReceipt->amount);die;

		// var_dump(getdate()['mon']);die;


		return view('account-sheet',compact('workers','levels','last_id','cashReceipt','projects_amount'));
	}

	public function saveAccountSheet(Request $request)
	{
		var_dump($request->all());die;


	}


	public function getLevels()
	{
	  	$level_code = Input::get('option');
	  	// $level_code = '12';
	  	// var_dump($level_code);die;
	  	if(strlen($level_code) == 2){
	  		$level = AccountingTreeLevelTwo::where('code', '=', $level_code)->firstOrFail();
		  	if($level_code == '11'){
		  		$fixedAssets =$level->fixedAssets();
	    		$levels = $fixedAssets->get(['code','title']);
		  	}else if($level_code == '12'){
	    		$currentAssets =$level->currentAssets();
	    		$levels = $currentAssets->get(['code','title']);
		  	}else if ($level_code == "21") {
		  		$currentLiabilities =$level->currentLiabilities();
	    		$levels = $currentLiabilities->get(['code','title']);
	        }else if ($level_code == "32") {
				$levelThreeOperationExpenses =$level->levelThreeOperationExpenses();
	    		$levels = $levelThreeOperationExpenses->get(['code','title']);
	        }else if ($level_code == "31") {
				$levelThreeGeneralExpenses =$level->levelThreeGeneralExpenses();
	    		$levels = $levelThreeGeneralExpenses->get(['code','title']);
	        }else if (strpos($level_code, '4', 0) !== false) {
				$levelThreeRevenues =$level->levelThreeRevenues();
	    		$levels = $levelThreeRevenues->get(['code','title']);
	    	}
	    }else if(strlen($level_code) == 4){
	    	if(substr($level_code, 0,2) == '12'){
			  	$level = CurrentAssets::where('code', '=', $level_code)->firstOrFail();
		    	if($level_code == '1201'){
		    		$treasury = $level->treasury();
		    		$levels = $treasury->get(['code','title']);
			  	}else if ($level_code == "1202") {
		    		$bank = $level->banks();
		    		$levels = $bank->get(['code','title']);
		        }else if ($level_code == "1203") {
		    		$bank = $level->advancedExpenses();
		    		$levels = $bank->get(['code','title']);
		        }else if ($level_code == "1204") {
		    		$bank = $level->depositsWithOthers();
		    		$levels = $bank->get(['code','title']);
		        }else if ($level_code == "1205") {
		    		$bank = $level->custodyAndAdvances();
		    		$levels = $bank->get(['code','title']);
		        }else if ($level_code == "1206") {
		    		$bank = $level->accuredRevenues();
		    		$levels = $bank->get(['code','title']);
		        }else if ($level_code == "1207") {
		    		$bank = $level->variousDebitors();
		    		$levels = $bank->get(['code','title']);
		        }else if ($level_code == "1208") {
		    		$bank = $level->otherDebitBalances();
		    		$levels = $bank->get(['code','title']);
		        }else if ($level_code == "1209") {
		    		$bank = $level->stores();
		    		$levels = $bank->get(['code','title']);
		        }else if ($level_code == "1210") {
		    		$bank = $level->receivableCheques();
		    		$levels = $bank->get(['code','title']);
		        }else if ($level_code == "1211") {
		    		$bank = $level->fawry();
		    		$levels = $bank->get(['code','title']);
		        }else if ($level_code == "1212") {
		    		$bank = $level->sms();
		    		$levels = $bank->get(['code','title']);
		        }else if ($level_code == "1213") {
		    		$bank = $level->cibMachine();
		    		$levels = $bank->get(['code','title']);
		        }else{

		        }
		    }else if (substr($level_code, 0,2) == '21'){
		    	$level = CurrentLiabilities::where('code', '=', $level_code)->firstOrFail();
		    	if($level_code == '2101'){
		    		$Suppliers = $level->suppliers();
		    		$levels = $Suppliers->get(['code','title']);
			  	}else if ($level_code == "2102") {
		    		$AccuredExpenses = $level->accuredExpenses();
		    		$levels = $AccuredExpenses->get(['code','title']);
		        }else if ($level_code == "2103") {
		    		$PayableCheques = $level->payableCheques();
		    		$levels = $PayableCheques->get(['code','title']);
		        }else if ($level_code == "2104") {
		    		$Taxes = $level->taxes();
		    		$levels = $Taxes->get(['code','title']);
		        }else if ($level_code == "2105") {
		    		$SocialInsurances = $level->socialInsurances();
		    		$levels = $SocialInsurances->get(['code','title']);
		        }else if ($level_code == "2106") {
		    		$PenalitiesFunds = $level->penalitiesFunds();
		    		$levels = $PenalitiesFunds->get(['code','title']);
		        }else if ($level_code == "2107") {
		    		$FriendshipFunds = $level->friendshipFunds();
		    		$levels = $FriendshipFunds->get(['code','title']);
		        }else if ($level_code == "2108") {
		    		$AmountsUnderAdjustments = $level->amountsUnderAdjustments();
		    		$levels = $AmountsUnderAdjustments->get(['code','title']);
		        }else if ($level_code == "2109") {
		    		$Creditors = $level->creditors();
		    		$levels = $Creditors->get(['code','title']);
		        }
		    }else if (substr($level_code, 0,2) == '31'){
		    	$level = LevelThreeGeneralExpenses::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '31', 0) !== false){
		    		$levelFour = $level->LevelFour();
		    		$levels = $levelFour->get(['code','title']);
			  	}
		    }else if (substr($level_code, 0,2) == '32'){
		    	$level = LevelThreeOperationExpenses::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '32', 0) !== false){
		    		$levelFour = $level->LevelFour();
		    		$levels = $levelFour->get(['code','title']);
			  	}
		    }else if (substr($level_code, 0,1) == '4'){
		    	$level = LevelThreeRevenues::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '4', 0) !== false){
		    		$levelFour = $level->LevelFour();
		    		$levels = $levelFour->get(['code','title']);
			  	}
		    }
	    }else if(strlen($level_code) == 6){
	    	if(substr($level_code, 0,4) == '1201'){
	    		$level = Treasury::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '1201', 0) !== false){
		    		$levelFive = $level->treasuryCurrencies();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '1202'){
	    		$level = Banks::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '1202', 0) !== false){
		    		$levelFive = $level->bankAccounts();
		    		$levels = $levelFive->get(['code','title']);
			  	}
	    	}else if(substr($level_code, 0,4) == '1203'){
	    		$level = AdvancedExpenses::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '1203', 0) !== false){
		    		$levelFive = $level->expensesItems();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '1204'){
	    		$level = DepositsWithOthers::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '1204', 0) !== false){
		    		$levelFive = $level->depositsWithOtherItems();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '1205'){
	    		$level = CustodyAndAdvances::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '1205', 0) !== false){
		    		$levelFive = $level->workers();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '1206'){
	    		$level = AccuredRevenues::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '1206', 0) !== false){
		    		$levelFive = $level->accuredRevenuesItems();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '1207'){
	    		$level = VariousDebitors::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '1207', 0) !== false){
		    		$levelFive = $level->bankAccounts();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '1208'){
	    		$level = OtherDebitBalances::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '1208', 0) !== false){
		    		$levelFive = $level->bankAccounts();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '1209'){
	    		$level = Stores::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '1209', 0) !== false){
		    		$levelFive = $level->storeItems();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '1210'){
	    		$level = ReceivableCheques::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '1210', 0) !== false){
		    		$levelFive = $level->bankAccounts();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '1211'){
	    		$level = Fawry::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '1211', 0) !== false){
		    		$levelFive = $level->fawryItems();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '1212'){
	    		$level = Sms::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '1212', 0) !== false){
		    		$levelFive = $level->bankAccounts();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '1213'){
	    		$level = CibMachine::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '1213', 0) !== false){
		    		$levelFive = $level->bankAccounts();
		    		$levels = $levelFive->get();
			  	}
	    	}


	    	else if(substr($level_code, 0,4) == '2101'){
	    		$level = Suppliers::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '2101', 0) !== false){
		    		$levelFive = $level->suppliersCreditors();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '2102'){
	    		$level = AccuredExpenses::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '2102', 0) !== false){
		    		$levelFive = $level->expensesItems();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '2103'){
	    		$level = PayableCheques::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '2103', 0) !== false){
		    		$levelFive = $level->bankAccounts();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '2104'){
	    		$level = Taxes::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '2104', 0) !== false){
		    		$levelFive = $level->bankAccounts();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '2105'){
	    		$level = SocialInsurances::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '2105', 0) !== false){
		    		$levelFive = $level->socialInsuranceItems();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '2106'){
	    		$level = PenalitiesFunds::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '2106', 0) !== false){
		    		$levelFive = $level->workers();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '2107'){
	    		$level = FriendshipFunds::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '2107', 0) !== false){
		    		$levelFive = $level->workers();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '2108'){
	    		$level = AmountsUnderAdjustments::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '2108', 0) !== false){
		    		$levelFive = $level->bankAccounts();
		    		$levels = $levelFive->get();
			  	}
	    	}else if(substr($level_code, 0,4) == '2109'){
	    		$level = Creditors::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '2109', 0) !== false){
		    		$levelFive = $level->bankAccounts();
		    		$levels = $levelFive->get();
			  	}
	    	}

	    	else if(substr($level_code, 0,4) == '3101'){
	    		$level = LevelFourGeneralExpenses::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '3101', 0) !== false){
		    		$levelFive = $level->expensesItems();
		    		$levels = $levelFive->get();
			  	}
	    	}

	    	else if(substr($level_code, 0,4) == '3201'){
	    		$level = LevelFourOperationExpenses::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '3201', 0) !== false){
		    		$levelFive = $level->expensesItems();
		    		$levels = $levelFive->get();
			  	}
	    	}

	    	else if(substr($level_code, 0,1) == '4'){
	    		$level = LevelFourRevenues::where('code', '=', $level_code)->firstOrFail();
		    	if(strpos($level_code, '0201', 2) !== false){
		    		$levelFive = $level->notebookLicenses();
		    		$levels = $levelFive->get();
			  	}else if(strpos($level_code, '0202', 2) !== false){
		    		$levelFive = $level->coupons();
		    		$levels = $levelFive->get();
			  	}else if(strpos($level_code, '0203', 2) !== false){
		    		$levelFive = $level->revenueBanks();
		    		$levels = $levelFive->get();
			  	}else if(strpos($level_code, '0204', 2) !== false){
		    		$levelFive = $level->revenueBenefits();
		    		$levels = $levelFive->get();
			  	}else if(strpos($level_code, '0205', 2) !== false){
		    		$levelFive = $level->revenueMalls();
		    		$levels = $levelFive->get();
			  	}else if(strpos($level_code, '0206', 2) !== false){
		    		$levelFive = $level->revenueSms();
		    		$levels = $levelFive->get();
			  	}else if(strpos($level_code, '0207', 2) !== false){
		    		$levelFive = $level->revenueFawries();
		    		$levels = $levelFive->get();
			  	}

	    	}

	    }else if(strlen($level_code) == 9){
			if(strpos($level_code, '0203', 2) !== false){
			    $level = RevenueBanks::where('code', '=', $level_code)->firstOrFail();
				$levelSix = $level->revenueBankAccounts();
		    	$levels = $levelSix->get();
			}else if(strpos($level_code, '0204', 0) !== false){
			    $level = RevenueBenefits::where('code', '=', $level_code)->firstOrFail();
				$levelSix = $level->revenueBenefitItems();
		    	$levels = $levelSix->get();
			}else if(strpos($level_code, '12020', 0) !== false){
			    $level = BankAccounts::where('code', '=', $level_code)->firstOrFail();
				$levelSix = $level->bankAccountItems();
		    	$levels = $levelSix->get();
			}

		}
         

		// var_dump($currentAssets);
		// var_dump($levels);die;
		return \Response::make($levels);
	}
}
