<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;

use App\AdvancedExpenses;
use App\AccuredRevenues;
use App\Stores;
use App\Fawry;
use App\Sms;
use App\CibMachine;
use App\AccuredExpenses;
use App\AdvancedExpenseExpensesItems;
use App\AccuredExpenseItems;
use App\ExpensesItems;
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

 			$items = ExpensesItems::all();
            foreach ($items as $item) {
                $advancedExpenseExpensesItem = new AdvancedExpenseExpensesItems();
                $advancedExpenseExpensesItem->advanced_expense_id = $advancedExpense->id;
                $advancedExpenseExpensesItem->expenses_item_id = $item->id;
                $advancedExpenseExpensesItem->save();
            
                $AccuredExpenseItem = new AccuredExpenseItems();
                $AccuredExpenseItem->accured_expense_id = $accuredExpense->id;
                $AccuredExpenseItem->expenses_item_id = $item->id;
                $AccuredExpenseItem->save();
            }
			// Adding project to every level in Current Liabilities of Accountinng tree .. 




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
