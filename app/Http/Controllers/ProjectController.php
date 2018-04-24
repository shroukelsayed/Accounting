<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;

use App\AdvancedExpenses;
use App\AccuredRevenues;
use App\AccuredRevenuesItems;
use App\AccuredItems;
use App\Stores;
use App\Fawry;
use App\Sms;
use App\CibMachine;
use App\AccuredExpenses;
use App\AdvancedExpenseExpensesItems;
use App\AccuredExpenseItems;
use App\ExpensesItems;

use App\FawryItems;
use App\FawryBanks;
use App\FawryFawryItems;
use App\FawryItemBanks;

use App\LevelThreeOperationExpenses;
use App\LevelFourOperationExpenses;
use App\OperationExpenseItems;
use App\SocialInsurances;
use App\SocialInsuranceItems;
use App\InsuranceItems;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Validator;
use DB;

class ProjectController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = Project::orderBy('id', 'desc')->paginate(10);

		return view('projects.index', compact('projects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('projects.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{

	    $validator = Validator::make($request->all(), array(
	        'name' => 'required|unique:projects',
	    ));
	    if($validator->fails()) {
	        return Redirect::back()
	            ->withErrors($validator)
	            ->WithInput();
	    }

	    // Start transaction!
		DB::beginTransaction();

		try {
			//first stage:
			//creating Project Object ...
            $last_project = Project::orderby('id', 'desc')->first();
			if(!is_null($last_project)){
	            $new_level_code = $last_project->code + 1;
	        }else{
	            $new_level_code  = 01;
           	}
           	$project = new Project();

			$project->name = $request->input('name');
			$project->code = $new_level_code;
			$project->user_id = Auth::user()->id;
			$project->published_at = Carbon::now();
			$project->save();

			// Adding project to every level in Current Assets of Accountinng tree .. 
			// 1- AdvancedExpenses
            $advancedExpense = new AdvancedExpenses();
            $lastAdvancedExpense = AdvancedExpenses::orderby('id', 'desc')->first();

            if(!is_null($lastAdvancedExpense)){
	            $new_level_code = $lastAdvancedExpense->code + 1;
	        }else{
	            $new_level_code  = "120301";
            }
            $advancedExpense->title = $project->name;
            $advancedExpense->code = $new_level_code;
           	$advancedExpense->level = 4;
	        $advancedExpense->parent = 3;    
	        $advancedExpense->debit = true;
 			$advancedExpense->credit = false;
 			$advancedExpense->save();        

 			// 2- AccuredRevenues
            $accuredRevenue = new AccuredRevenues();
            $lastAccuredRevenue = AccuredRevenues::orderby('id', 'desc')->first();

            if(!is_null($lastAccuredRevenue)){
	            $new_level_code = $lastAccuredRevenue->code + 1;
	        }else{
	            $new_level_code  = "120601";
            }
            $accuredRevenue->title = $project->name;
            $accuredRevenue->code = $new_level_code;
           	$accuredRevenue->level = 4;
	        $accuredRevenue->parent = 6;    
	        $accuredRevenue->debit = true;
 			$accuredRevenue->credit = false;
 			$accuredRevenue->save();

 			$AccuredRevenues = AccuredRevenuesItems::all();
	        foreach ($AccuredRevenues as $Accured_Revenue) {
	            $AccountItem = new AccuredItems();
	            $AccountItem->accured_revenue_id  = $accuredRevenue->id;
	            $AccountItem->accured_revenues_item_id = $Accured_Revenue->id;
	            $AccountItem->code = $accuredRevenue->code."".$Accured_Revenue->code;
	            $AccountItem->save();
	        }

 			// 3- Stores
            $store = new Stores();
            $lastStore = Stores::orderby('id', 'desc')->first();

            if(!is_null($lastStore)){
	            $new_level_code = $lastStore->code + 1;
	        }else{
	            $new_level_code  = "120901";
            }
            $store->title = $project->name;
            $store->code = $new_level_code;
           	$store->level = 4;
	        $store->parent = 9;    
	        $store->debit = true;
 			$store->credit = false;
 			$store->save();

 			// 4- Fawry
            $fawry = new Fawry();
            $lastFawry = Fawry::orderby('id', 'desc')->first();

            if(!is_null($lastFawry)){
	            $new_level_code = $lastFawry->code + 1;
	        }else{
	            $new_level_code  = "121101";
            }
            $fawry->title = $project->name;
            $fawry->code = $new_level_code;
           	$fawry->level = 4;
	        $fawry->parent = 11;    
	        $fawry->debit = true;
 			$fawry->credit = false;
 			$fawry->save();

 			$FawryItems = FawryItems::all();
	        $fawryBanks = FawryBanks::all();

	        foreach ($FawryItems as $FawryItem) {
	            $fawryFawryItem = new FawryFawryItems();
	            $fawryFawryItem->fawry_id = $fawry->id;
	            $fawryFawryItem->fawry_item_id = $FawryItem->id;
	            $fawryFawryItem->code = $fawry->code."".$FawryItem->code;
	            $fawryFawryItem->save();

	            foreach ($fawryBanks as $fawryBank) {
		            if($fawryFawryItem->fawry_item_id == 2){
		                $fawryItemBank = new FawryItemBanks();
		                $fawryItemBank->fawry_item_id = $fawryFawryItem->id;
		                $fawryItemBank->fawry_bank_id = $fawryBank->id;
		                $fawryItemBank->code = $fawryFawryItem->code.''.$fawryBank->code;
		                $fawryItemBank->save();
		                break;
		            }
		        }

	        }
 			// 5- Sms
            $sms = new Sms();
            $lastSms = Sms::orderby('id', 'desc')->first();

            if(!is_null($lastSms)){
	            $new_level_code = $lastSms->code + 1;
	        }else{
	            $new_level_code  = "121201";
            }
            $sms->title = $project->name;
            $sms->code = $new_level_code;
           	$sms->level = 4;
	        $sms->parent = 12;    
	        $sms->debit = true;
 			$sms->credit = false;
 			$sms->save();

 			// 6- CibMachine
            $cibMachine = new CibMachine();
            $lastCibMachine = CibMachine::orderby('id', 'desc')->first();

            if(!is_null($lastCibMachine)){
	            $new_level_code = $lastCibMachine->code + 1;
	        }else{
	            $new_level_code  = "121301";
            }
            $cibMachine->title = $project->name;
            $cibMachine->code = $new_level_code;
           	$cibMachine->level = 4;
	        $cibMachine->parent = 13;    
	        $cibMachine->debit = true;
 			$cibMachine->credit = false;
 			$cibMachine->save();
			// Adding project to every level in Current Assets of Accountinng tree .. 

			// Adding project to every level in Current Liabilities of Accountinng tree .. 
 			// 1- AccuredExpenses
            $accuredExpense = new AccuredExpenses();
            $lastAccuredExpense = AccuredExpenses::orderby('id', 'desc')->first();

            if(!is_null($lastAccuredExpense)){
	            $new_level_code = $lastAccuredExpense->code + 1;
	        }else{
	            $new_level_code  = "210201";
            }
            $accuredExpense->title = $project->name;
            $accuredExpense->code = $new_level_code;
           	$accuredExpense->level = 4;
	        $accuredExpense->parent = 2;    
	        $accuredExpense->debit = false;
 			$accuredExpense->credit = true;
 			$accuredExpense->save();
 			// 2- Social Insurance
 			$socialInsuranceItem = new SocialInsuranceItems();
            $lastSocialInsuranceItem = SocialInsuranceItems::orderby('id', 'desc')->first();

            if(!is_null($lastSocialInsuranceItem)){
	            $new_level_code = str_pad($lastSocialInsuranceItem->code + 1, 3, '0', STR_PAD_LEFT);
	        }else{
	            $new_level_code = "001";
	        }
            $socialInsuranceItem->title = $project->name;
            $socialInsuranceItem->code = $new_level_code;
           	$socialInsuranceItem->level = 6;
	        $socialInsuranceItem->debit = false;
 			$socialInsuranceItem->credit = true;
 			$socialInsuranceItem->save();

 			$SocialInsurances = SocialInsurances::all();
	        foreach ($SocialInsurances as $SocialInsurance) {
	            $InsuranceItem = new InsuranceItems();
	            $InsuranceItem->social_insurance_id  = $SocialInsurance->id;
	            $InsuranceItem->social_insurance_item_id = $socialInsuranceItem->id;
	            $InsuranceItem->code = $SocialInsurance->code."".$socialInsuranceItem->code;
	            $InsuranceItem->save();
	        }
			// Adding project to every level in Current Liabilities of Accountinng tree .. 

			// Adding project to every level in Expenses of Accountinng tree .. 
 			// 1- Operation Expenses
 			$level_three_OE = new LevelThreeOperationExpenses();
            $last_level_three_OE = LevelThreeOperationExpenses::orderby('id', 'desc')->first();

            if(!is_null($last_level_three_OE)){
	            $new_level_code = $last_level_three_OE->code + 1;
	        }else{
	            $new_level_code  = "3201";
            }
            $level_three_OE->title = $project->name;
            $level_three_OE->code = $new_level_code;
           	$level_three_OE->level = 3;
	        $level_three_OE->parent = 5;    
	        $level_three_OE->debit = true;
 			$level_three_OE->credit = false;
 			$level_three_OE->save();

 			$level_four_OE = new LevelFourOperationExpenses();
            $last_level_four_OE = LevelFourOperationExpenses::orderby('id', 'desc')->first();

            if(!is_null($last_level_four_OE)){
	            $new_level_code = $last_level_four_OE->code + 1;
	        }else{
	            $new_level_code  = $level_three_OE->code . '01';
            }
            $level_four_OE->title = $project->name;
            $level_four_OE->code = $new_level_code;
           	$level_four_OE->level = 4;
	        $level_four_OE->parent = $level_three_OE->id;    
	        $level_four_OE->debit = true;
 			$level_four_OE->credit = false;
 			$level_four_OE->save();
			// Adding project to every level in Expenses of Accountinng tree .. 


 			// Adding Expenses Items in All levels of Accountinng tree ...
 			$items = ExpensesItems::all();
            foreach ($items as $item) {
                $advancedExpenseExpensesItem = new AdvancedExpenseExpensesItems();
                $advancedExpenseExpensesItem->advanced_expense_id = $advancedExpense->id;
                $advancedExpenseExpensesItem->expenses_item_id = $item->id;
                $advancedExpenseExpensesItem->code = $advancedExpense->code."".$item->code;
                $advancedExpenseExpensesItem->save();
            
                $AccuredExpenseItem = new AccuredExpenseItems();
                $AccuredExpenseItem->accured_expense_id = $accuredExpense->id;
                $AccuredExpenseItem->expenses_item_id = $item->id;
                $AccuredExpenseItem->code = $accuredExpense->code."".$item->code;
                $AccuredExpenseItem->save();

                $OperationExpenseItem = new OperationExpenseItems();
                $OperationExpenseItem->operation_expense_id = $level_four_OE->id;
                $OperationExpenseItem->expenses_item_id = $item->id;
                $OperationExpenseItem->code = $level_four_OE->code."".$item->code;
                $OperationExpenseItem->save();
            }
 			// Adding Expenses Items in All levels of Accountinng tree ...




		} catch(\Exception $e){
		    DB::rollback();
		    throw $e;
		}

		// If we reach here, then
		// data is valid and working.
		// Commit the queries!
		DB::commit();

		return redirect()->route('projects.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$project = Project::findOrFail($id);

		return view('projects.show', compact('project'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$project = Project::findOrFail($id);

		return view('projects.edit', compact('project'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		
		$validator = Validator::make($request->all(), array(
	        'name' => 'required|unique:projects,name,'.$id,
	        'code' => 'required|unique:projects,code,'.$id,
	    ));
	    if($validator->fails()) {
	        return Redirect::back()
	            ->withErrors($validator)
	            ->WithInput();
	    }

		$project = Project::findOrFail($id);

		$project->name = $request->input('name');
		$project->code = $request->input('code');

		$project->save();

		return redirect()->route('projects.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$project = Project::findOrFail($id);
		$project->delete();

		return redirect()->route('projects.index')->with('message', 'Item deleted successfully.');
	}

}
