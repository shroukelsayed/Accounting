<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\AccountingTreeLevelOne;
use App\AccountingTreeLevelTwo;
use App\FixedAssets;

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
use App\Workers;
use App\Deposits;
use App\AccuredRevenuesFawryBanks;
use App\AccuredRevenuesFawries;

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

use App\Role;
use DateTime;
use DB;
use Validator;
use Auth;
use App;
use Illuminate\Support\Facades\Redirect;

class AccountingTreeController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth',['except' =>[ 'show','create','store']]);
        $this->middleware('admin',['only' =>[ 'index']]);
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        //
        $levels = AccountingTreeLevelOne::orderBy('id', 'asc')->paginate(10);
        return view('accounting-tree.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('accounting-tree.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:accounting_tree_level_ones',
            'code' => 'required|numeric|unique:accounting_tree_level_ones',
            'type' => 'required',
        ]);
        if($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->WithInput();
        }

        $level_one = new AccountingTreeLevelOne();
        $level_one->level = 1;
        $level_one->code = $request->input('code');
        $level_one->title = $request->input('title');

        if($request->input('type') == 'credit'){
            $level_one->debit = false;
            $level_one->credit = true;
        }else{
            $level_one->debit = true;
            $level_one->credit = false;
        }
        
        $level_one->save();

        return redirect()->route('accounting-tree.index')->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $level = AccountingTreeLevelOne::findOrFail($id);
        // foreach ($level->levelTwo as $level_two ) {
        //     foreach ($level_two->currentAssets as $currentAsset ) {
        //        foreach ($currentAsset->fawry as $fawry) {
        //            foreach ($fawry->fawryItems as $item) {
        //                # code...
        //             // var_dump($item->fawryItemBanks);
        //                 if(!is_null($item->fawryItemBanks)){
        //                     foreach ($item->fawryItemBanks as $bank) {
        //                         var_dump($bank->title);
                            
        //                     }
        //                 }
                        
        //            }

        //        }
        //     }
        // }
       
        // die;
        return view('accounting-tree.show', compact('level'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $level = AccountingTreeLevelOne::findOrFail($id);

        return view('accounting-tree.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);

        // var_dump($request->all());die;
        $user->name = $request['user_name'];
        $user->email = $request['email'];
        $user->password = md5($request['password']);
        $user->role = (int)$request['role'];

        $user->save();

        return redirect()->route('accounting-tree.index')->with('message', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('accounting-tree.index')->with('message', 'Item deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addChild(Request $request)
    {
        // var_dump($request->all());die;

        // Start transaction!
        DB::beginTransaction();

        try {
            if($request->input('parent_level') == '2'){
                if($request->input('parent_code') == '11'){
                    $level = new FixedAssets();
                    $last_level = FixedAssets::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '12'){
                    $level = new CurrentAssets();
                    $last_level = CurrentAssets::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '21'){
                    $level = new CurrentLiabilities();
                    $last_level = CurrentLiabilities::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '31'){
                    $level = new LevelThreeGeneralExpenses();
                    $last_level = LevelThreeGeneralExpenses::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '32'){
                    $level = new LevelThreeOperationExpenses();
                    $last_level = LevelThreeOperationExpenses::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '43'){ // for deposits .. 
                    $level = new LevelThreeRevenues();
                    $last_level = LevelThreeRevenues::where('code','like', '%43%')->orderby('id', 'desc')->first();
                }
            }elseif($request->input('parent_level') == '3'){
                //// Current Assets Level 4 
                if($request->input('parent_code') == '1201'){
                    $level = new Treasury();
                    $last_level = Treasury::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '1202'){
                    $level = new Banks();
                    $last_level = Banks::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '1203'){
                    $level = new AdvancedExpenses();
                    $last_level = AdvancedExpenses::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '1204'){
                    $level = new DepositsWithOthers();
                    $last_level = DepositsWithOthers::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '1205'){
                    $level = new CustodyAndAdvances();
                    $last_level = CustodyAndAdvances::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '1206'){
                    $level = new AccuredRevenues();
                    $last_level = AccuredRevenues::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '1207'){
                    $level = new VariousDebitors();
                    $last_level = VariousDebitors::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '1208'){
                    $level = new OtherDebitBalances();
                    $last_level = OtherDebitBalances::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '1209'){
                    $level = new Stores();
                    $last_level = Stores::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '1210'){
                    $level = new ReceivableCheques();
                    $last_level = ReceivableCheques::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '1211'){
                    $level = new Fawry();
                    $last_level = Fawry::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '1212'){
                    $level = new Sms();
                    $last_level = Sms::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '1213'){
                    $level = new CibMachine();
                    $last_level = CibMachine::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '1214'){
                    $level = new Deposits();
                    $last_level = Deposits::orderby('id', 'desc')->first();
                }
                //// Current Assets Level 4 

                //// Current Liabilities Level 4 
                elseif($request->input('parent_code') == '2101'){
                    $level = new Suppliers();
                    $last_level = Suppliers::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '2102'){
                    $level = new AccuredExpenses();
                    $last_level = AccuredExpenses::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '2103'){
                    $level = new PayableCheques();
                    $last_level = PayableCheques::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '2104'){
                    $level = new Taxes();
                    $last_level = Taxes::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '2105'){
                    $level = new SocialInsurances();
                    $last_level = SocialInsurances::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '2106'){
                    $level = new PenalitiesFunds();
                    $last_level = PenalitiesFunds::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '2107'){
                    $level = new FriendshipFunds();
                    $last_level = FriendshipFunds::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '2108'){
                    $level = new AmountsUnderAdjustments();
                    $last_level = AmountsUnderAdjustments::orderby('id', 'desc')->first();
                }else if($request->input('parent_code') == '2109'){
                    $level = new Creditors();
                    $last_level = Creditors::orderby('id', 'desc')->first();
                }
                //// Current Liabilities Level 4 

                //// Expenses Level 4 
                elseif(strpos($request->input('parent_code'), '31') !== false){
                    $level = new LevelFourGeneralExpenses();
                    $last_level = LevelFourGeneralExpenses::orderby('id', 'desc')->first();

                    // $items = ExpensesItems::all();
                    // foreach ($items as $item) {
                    //     $GeneralExpenseItem = new GeneralExpenseItems();
                    //     $GeneralExpenseItem->general_expense_id = $level->id;
                    //     $GeneralExpenseItem->expenses_item_id = $item->id;
                    //     $GeneralExpenseItem->code = $level->code.''.$item->code;

                    //     $GeneralExpenseItem->save();
                    // }

                }else if(strpos($request->input('parent_code'), '32') !== false){
                    $level = new LevelFourOperationExpenses();
                    $last_level = LevelFourOperationExpenses::orderby('id', 'desc')->first();
                }
                //// Expenses Level 4 

                //// Revenues Level 4 
                else if(strpos($request->input('parent_code'), '41') !== false){
                    $level = new LevelFourRevenues();
                    $last_level = LevelFourRevenues::where('code','like', '%43%')->orderby('id', 'desc')->first();
                }
            }elseif($request->input('parent_level') == '4'){
                if(strpos($request->input('parent_code'), '1202') !== false){
                    $level = new BankAccounts();
                    $last_level = BankAccounts::orderby('id', 'desc')->first();
                }elseif($request->input('parent_code') == '121101'){
                    $level = new FawryItems();
                    $last_level = FawryItems::orderby('id', 'desc')->first();
                }elseif($request->input('parent_code') == '120401'){
                    $level = new DepositsWithOtherItems();
                    $last_level = DepositsWithOtherItems::orderby('id', 'desc')->first();
                }elseif(strpos($request->input('parent_code'), '1206') !== false){
                    $level = new AccuredRevenuesItems();
                    $last_level = AccuredRevenuesItems::where('code','like', $request->input('parent_code').'%')->orderby('id', 'desc')->first();
                }elseif(strpos($request->input('parent_code'), '1209') !== false){
                    $level = new StoreItems();
                    $last_level = StoreItems::orderby('id', 'desc')->first();
                }elseif(strpos($request->input('parent_code'), '2101') !== false){
                    $level = new SuppliersCreditors();
                    $last_level = SuppliersCreditors::orderby('id', 'desc')->first();
                }
            }elseif($request->input('parent_level') == '5'){
                if($request->input('parent_code') == '120201001'){
                    $level = new BankAccountItems();
                    $last_level = BankAccountItems::orderby('id', 'desc')->first();
                }elseif($request->input('parent_code') == '121101002'){
                    $level = new FawryBanks();
                    $last_level = FawryBanks::orderby('id', 'desc')->first();
                }elseif(strpos($request->input('parent_code'), '1206') !== false){
                    $level = new AccuredRevenuesFawries();
                    $last_level = AccuredRevenuesFawries::where('code','like', $request->input('parent_code').'%')->orderby('id', 'desc')->first();
                }elseif (preg_match('^4[0-9]{1}0203001^','420203001') || preg_match('^4[0-9]{1}0203001^','420203002')) {
                    # code...
                    var_dump("jhjhh");
                    die;
                }
            }elseif($request->input('parent_level') == '6'){
                if(strpos($request->input('parent_code'), '1206') !== false){
                    $level = new AccuredRevenuesFawryBanks();
                    $last_level = AccuredRevenuesFawryBanks::where('code','like', $request->input('parent_code').'%')->orderby('id', 'desc')->first();
                }
            }


            // var_dump($last_level);die();
            if( !is_null($last_level)){
                $new_level_code = $last_level->code + 1;
            }else{
                if($request->input('parent_level') == '3' || $request->input('parent_level') == '2'){
                    $new_level_code  = $request->input('parent_code')."01";
                }elseif($request->input('parent_level') == '4'){
                    $new_level_code  = $request->input('parent_code')."001";
                }elseif($request->input('parent_level') == '5'){
                    $new_level_code  = $request->input('parent_code')."0001";
                }elseif($request->input('parent_level') == '6'){
                    $new_level_code  = $request->input('parent_code')."001";
                }
                // var_dump($new_level_code);die;
            }

            $level->level = $request->input('parent_level') +1;
            $level->parent = $request->input('parent_id');
            $level->code = $new_level_code;
            $level->title = $request->input('level_title');

            if($request->input('type') == 'credit'){
                $level->debit = false;
                $level->credit = true;
            }else{
                $level->debit = true;
                $level->credit = false;
            }
            
            $level->save();

            if($request->input('parent_level') == '4' ){
                if(strpos($request->input('parent_code'), '1202') !== false){
                    // Add all items to new account ..
                    $items = BankAccountItems::all();
                    foreach ($items as $item) {
                        $accountItem = new AccountItems();
                        $accountItem->bank_account_id = $level->id;
                        $accountItem->bank_account_item_id = $item->id;
                        $accountItem->code = $level->code."".$item->code;

                        $accountItem->save();
                    }
                // }elseif(strpos($request->input('parent_code'), '2106') !== false){
                //     $items = Workers::all();
                //     foreach ($items as $item) {
                //         $PenalitiesFundWorkers = new PenalitiesFundWorkers();
                //         $PenalitiesFundWorkers->general_expense_id = $level->id;
                //         $PenalitiesFundWorkers->expenses_item_id = $item->id;
                //         $PenalitiesFundWorkers->code = $level->code.''.$item->code;

                //         $PenalitiesFundWorkers->save();
                //     }
                // }elseif(strpos($request->input('parent_code'), '2107') !== false){
                    
                }
            }elseif($request->input('parent_level') == '3'){
                if(strpos($request->input('parent_code'), '31') !== false){
                    $items = ExpensesItems::all();
                    foreach ($items as $item) {
                        $GeneralExpenseItem = new GeneralExpenseItems();
                        $GeneralExpenseItem->general_expense_id = $level->id;
                        $GeneralExpenseItem->expenses_item_id = $item->id;
                        $GeneralExpenseItem->code = $level->code.''.$item->code;
                        $GeneralExpenseItem->save();
                    }
                }elseif ($request->input('parent_code') == '1203') {
                    $items = ExpensesItems::all();
                    foreach ($items as $item) {
                        $advancedExpenseExpensesItem = new AdvancedExpenseExpensesItems();
                        $advancedExpenseExpensesItem->advanced_expense_id = $level->id;
                        $advancedExpenseExpensesItem->expenses_item_id = $item->id;
                        $advancedExpenseExpensesItem->code = $level->code."".$item->code;
                        $advancedExpenseExpensesItem->save();
                    }
                }
            }
        } catch(\Exception $e){
            DB::rollback();
            throw $e;
        }

        // If we reach here, then
        // data is valid and working.
        // Commit the queries!
        DB::commit();

        
        return Redirect::back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function expensesItem()
    {
        return view('accounting-tree.add-expenses-item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addExpensesItem(Request $request)
    {
        // var_dump($request);die;

        // Start transaction!
        DB::beginTransaction();

        try {
            $last_item = ExpensesItems::orderby('id', 'desc')->first();
            $item = new ExpensesItems();


            if(!is_null($last_item)){
                $new_level_code = str_pad($last_item->code + 1, 3, '0', STR_PAD_LEFT);
            }else{
                $new_level_code = "001";
            }
            $item->level = 5;
            $item->code = $new_level_code;
            $item->title = $request->input('title');
            $item->debit = false;
            $item->credit = true;
            $item->save();

            $AccuredExpenses = AccuredExpenses::all();
            foreach ($AccuredExpenses as $AccuredExpense) {
                $AccuredExpenseItem = new AccuredExpenseItems();
                $AccuredExpenseItem->accured_expense_id = $AccuredExpense->id;
                $AccuredExpenseItem->expenses_item_id = $item->id;
                $AccuredExpenseItem->code = $AccuredExpense->code .''. $item->code;
                $AccuredExpenseItem->save();
            }

            $advancedExpenses = AdvancedExpenses::all();
            foreach ($advancedExpenses as $advancedExpense) {
                $advancedExpenseExpensesItem = new AdvancedExpenseExpensesItems();
                $advancedExpenseExpensesItem->advanced_expense_id = $advancedExpense->id;
                $advancedExpenseExpensesItem->expenses_item_id = $item->id;
                $advancedExpenseExpensesItem->code = $advancedExpense->code .''. $item->code;
                $advancedExpenseExpensesItem->save();
            }

            $LevelFourOperationExpenses = LevelFourOperationExpenses::all();
            foreach ($LevelFourOperationExpenses as $LevelFourOperationExpense) {
                $OperationExpenseItem = new OperationExpenseItems();
                $OperationExpenseItem->operation_expense_id = $LevelFourOperationExpense->id;
                $OperationExpenseItem->expenses_item_id = $item->id;
                $OperationExpenseItem->code = $LevelFourOperationExpense->code."".$item->code;
                $OperationExpenseItem->save();
            }

            $LevelFourGeneralExpenses = LevelFourGeneralExpenses::all();
            foreach ($LevelFourGeneralExpenses as $LevelFourGeneralExpense) {
                $GeneralExpenseItem = new GeneralExpenseItems();
                $GeneralExpenseItem->general_expense_id = $LevelFourGeneralExpense->id;
                $GeneralExpenseItem->expenses_item_id = $item->id;
                $GeneralExpenseItem->code = $LevelFourGeneralExpense->code."".$item->code;
                $GeneralExpenseItem->save();
            }
            // var_dump("done");
            // die;

        } catch(\Exception $e){
            DB::rollback();
            throw $e;
        }

        // If we reach here, then
        // data is valid and working.
        // Commit the queries!
        DB::commit();

        return view('accounting-tree.add-expenses-item')->with('message', 'Item deleted successfully.');

    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fawryBank()
    {

        return view('accounting-tree.add-fawry-bank');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addFawryBank(Request $request)
    {
        // var_dump($request);die;
        $last_item = FawryBanks::orderby('id', 'desc')->first();
        $item = new FawryBanks();

        if(!is_null($last_item)){
            $new_level_code = str_pad($last_item->code + 1, 4, '0', STR_PAD_LEFT);
        }else{
            $new_level_code = "0001";
        }
        $item->level = 6;
        $item->code = $new_level_code;
        $item->title = $request->input('title');
        $item->debit = false;
        $item->credit = true;
        $item->save();
        /// Add new bank to all items ..
        $fawryItems = FawryItems::all();
        foreach ($fawryItems as $fawryItem) {
            if($fawryItem->title == ' بنك '){
                $fawryItemBank = new FawryItemBanks();
                $fawryItemBank->fawry_item_id = $fawryItem->id;
                $fawryItemBank->fawry_bank_id = $item->id;
                $fawryItemBank->code = $fawryItem->code.''.$item->code;
                $fawryItemBank->save();
                break;
            }
        }

        return view('accounting-tree.add-fawry-bank')->with('message', 'Item deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bankAccountItem()
    {
        $all_items = BankAccountItems::all();
        return view('accounting-tree.add-bank-account-item',compact('all_items'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addBankAccountItem(Request $request)
    {
        // var_dump($request->all());die;

        $all_items = BankAccountItems::all();
        
        $last_item = BankAccountItems::orderby('id', 'desc')->first();
        $item = new BankAccountItems();

        if(!is_null($last_item)){
            $new_level_code = str_pad($last_item->code + 1, 4, '0', STR_PAD_LEFT);
        }else{
            $new_level_code = "0001";
        }
        $item->level = 5;
        $item->code = $new_level_code;
        $item->title = $request->input('title');
        $item->debit = false;
        $item->credit = true;
        $item->save();

        $BankAccounts = BankAccounts::all();
        foreach ($BankAccounts as $BankAccount) {
            $accountItem = new AccountItems();
            $accountItem->bank_account_id = $BankAccount->id;
            $accountItem->bank_account_item_id = $item->id;
            $accountItem->code = $BankAccount->code."".$item->code;
            $accountItem->save();
        }
        return view('accounting-tree.add-bank-account-item',compact('all_items'))->with('message', 'Item added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function worker()
    {
        return view('accounting-tree.add-worker');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addWorker(Request $request)
    {
        // var_dump($request->all());die;
        $last_item = Workers::orderby('id', 'desc')->first();
        $item = new Workers();

        if(!is_null($last_item)){
            $new_level_code = str_pad($last_item->code + 1, 3, '0', STR_PAD_LEFT);
        }else{
            $new_level_code = "001";
        }
        $item->level = 5;
        $item->code = $new_level_code;
        $item->title = $request->input('title');
        $item->debit = false;
        $item->credit = true;
        $item->save();

        $CustodyAndAdvances = CustodyAndAdvances::all();
        $PenalitiesFunds = PenalitiesFunds::all();
        $FriendshipFunds = FriendshipFunds::all();
        foreach ($CustodyAndAdvances as $CustodyAndAdvance) {
            $CustodyAndAdvanceWorker = new CustodyAndAdvanceWorkers();
            $CustodyAndAdvanceWorker->custody_and_advance_id = $CustodyAndAdvance->id;
            $CustodyAndAdvanceWorker->worker_id = $item->id;
            $CustodyAndAdvanceWorker->code = $CustodyAndAdvance->code."".$item->code;
            $CustodyAndAdvanceWorker->save();
        }

        foreach ($PenalitiesFunds as $PenalitiesFunds) {
            $PenalitiesFundWorker = new PenalitiesFundWorkers();
            $PenalitiesFundWorker->penalities_fund_id = $PenalitiesFunds->id;
            $PenalitiesFundWorker->worker_id = $item->id;
            $PenalitiesFundWorker->code = $PenalitiesFunds->code.''.$item->code;
            $PenalitiesFundWorker->save();
        }

        foreach ($FriendshipFunds as $FriendshipFunds) {
            $FriendshipFundWorker = new FriendshipFundWorkers();
            $FriendshipFundWorker->friendship_fund_id = $FriendshipFunds->id;
            $FriendshipFundWorker->worker_id = $item->id;
            $FriendshipFundWorker->code = $FriendshipFunds->code.''.$item->code;
            $FriendshipFundWorker->save();            
        }
        return view('accounting-tree.add-worker')->with('message', 'Item added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function revenueItem()
    {
        return view('accounting-tree.add-revenue-item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addRevenueItem(Request $request)
    {
        // var_dump($request->all());die;
        $last_item = AccuredRevenuesItems::orderby('id', 'desc')->first();
        $item = new AccuredRevenuesItems();

        if(!is_null($last_item)){
            $new_level_code = str_pad($last_item->code + 1, 3, '0', STR_PAD_LEFT);
        }else{
            $new_level_code = "001";
        }
        $item->level = 5;
        $item->code = $new_level_code;
        $item->title = $request->input('title');
        $item->debit = false;
        $item->credit = true;
        $item->parent = 0;
        $item->save();

        $AccuredRevenues = AccuredRevenues::all();
        foreach ($AccuredRevenues as $AccuredRevenue) {
            $AccountItem = new AccuredItems();
            $AccountItem->accured_revenue_id  = $AccuredRevenue->id;
            $AccountItem->accured_revenues_item_id = $item->id;
            $AccountItem->code = $AccuredRevenue->code."".$item->code;
            $AccountItem->save();
        }
        return view('accounting-tree.add-revenue-item')->with('message', 'Item added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function insuranceItem()
    {
        return view('accounting-tree.add-insurance-item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addInsuranceItem(Request $request)
    {
        // var_dump($request->all());die;
        $last_item = SocialInsuranceItems::orderby('id', 'desc')->first();
        $item = new SocialInsuranceItems();

        if(!is_null($last_item)){
            $new_level_code = str_pad($last_item->code + 1, 3, '0', STR_PAD_LEFT);
        }else{
            $new_level_code = "001";
        }
        $item->level = 5;
        $item->code = $new_level_code;
        $item->title = $request->input('title');
        $item->debit = true;
        $item->credit = false;
        $item->save();

        $SocialInsurances = SocialInsurances::all();
        foreach ($SocialInsurances as $SocialInsurance) {
            $InsuranceItem = new InsuranceItems();
            $InsuranceItem->social_insurance_id  = $SocialInsurance->id;
            $InsuranceItem->social_insurance_item_id = $item->id;
            $InsuranceItem->code = $SocialInsurance->code."".$item->code;

            $InsuranceItem->save();
        }
        return view('accounting-tree.add-insurance-item')->with('message', 'Item added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function coupon()
    {
        return view('accounting-tree.add-coupon');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addCoupon(Request $request)
    {
        // var_dump($request->all());die;
        $last_item = Coupons::orderby('id', 'desc')->first();
        $item = new Coupons();
        // $items = Coupons::all();

        if(!is_null($last_item)){
            $new_level_code = str_pad($last_item->code + 1, 3, '0', STR_PAD_LEFT);
        }else{
            $new_level_code = "001";
        }
        $item->level = 5;
        $item->code = $new_level_code;
        $item->title = $request->input('title');
        $item->debit = true;
        $item->credit = false;
        $item->save();

        $LevelFourRevenues = DB::table('level_four_revenues')
                                ->where('title', 'like', '% كوبونات %' )->get();
        // foreach ($items as $item) {
            
            foreach ($LevelFourRevenues as $LevelFourRevenue) {
                $RevenueCoupon = new RevenueCoupons();
                $RevenueCoupon->level_four_revenue_id  = $LevelFourRevenue->id;
                $RevenueCoupon->coupon_id = $item->id;
                $RevenueCoupon->code = $LevelFourRevenue->code."".$item->code;

                $RevenueCoupon->save();
            }
        // }
        return view('accounting-tree.add-coupon')->with('message', 'Item added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function revenueBankAccount()
    {
        $banks = RevenueBanks::pluck('title','id');
        return view('accounting-tree.add-revenue-bank-account',compact('banks'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addRevenueBankAccount(Request $request)
    {
        // var_dump($request->all());

        $last_item = DB::table('revenue_bank_accounts')
                        ->where('revenue_bank_id',  $request->input('bank_id'))->orderBy('id', 'desc')->first();
        $bank = RevenueBanks::findOrFail($request->input('bank_id'));       

        $item = new RevenueBankAccounts();

        if(!is_null($last_item)){
            $new_level_code = str_pad($last_item->code + 1, 4, '0', STR_PAD_LEFT);
        }else{
            $new_level_code = $bank->code."0001";
        }
        $item->level = 6;
        $item->code = $new_level_code;
        $item->title = $request->input('title');
        $item->revenue_bank_id = $request->input('bank_id');
        $item->level_four_revenue_id = $bank->parent;
        $item->save();

        $banks = RevenueBanks::pluck('title','id');

        return view('accounting-tree.add-revenue-bank-account',compact('banks'))->with('message', 'Item added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function revenueBenefitItem()
    {
        $benefits = RevenueBenefits::pluck('title','id');
        return view('accounting-tree.add-revenue-benefit-item',compact('benefits'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addRevenueBenefitItem(Request $request)
    {
        $last_item = DB::table('revenue_benefit_items')
                        ->where('revenue_benefit_id',  $request->input('benefit_id'))->orderBy('id', 'desc')->first();
        $benefit = RevenueBenefits::findOrFail($request->input('benefit_id'));       

        $item = new RevenueBenefitItems();

        if(!is_null($last_item)){
            $new_level_code = str_pad($last_item->code + 1, 4, '0', STR_PAD_LEFT);
        }else{
            $new_level_code = $benefit->code."0001";
        }
        $item->level = 6;
        $item->code = $new_level_code;
        $item->title = $request->input('title');
        $item->revenue_benefit_id = $request->input('benefit_id');
        $item->level_four_revenue_id = $benefit->parent;
        $item->save();

        $benefits = RevenueBenefits::pluck('title','id');

        return view('accounting-tree.add-revenue-benefit-item',compact('benefits'))->with('message', 'Item added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function revenueFawryItem()
    {
        $fawries = RevenueFawries::pluck('title','id');
        return view('accounting-tree.add-revenue-fawry-item',compact('fawries'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addRevenueFawryItem(Request $request)
    {
        $last_item = DB::table('revenue_fawry_items')
                        ->where('revenue_fawry_id',  $request->input('fawry_id'))->orderBy('id', 'desc')->first();
        $fawry = RevenueFawries::findOrFail($request->input('fawry_id'));       

        $item = new RevenueFawryItems();

        if(!is_null($last_item)){
            $new_level_code = str_pad($last_item->code + 1, 4, '0', STR_PAD_LEFT);
        }else{
            $new_level_code = $fawry->code."0001";
        }
        $item->level = 6;
        $item->code = $new_level_code;
        $item->title = $request->input('title');
        $item->revenue_fawry_id = $request->input('fawry_id');
        $item->level_four_revenue_id = $fawry->parent;
        $item->save();

        $fawries = RevenueFawries::pluck('title','id');

        return view('accounting-tree.add-revenue-fawry-item',compact('fawries'))->with('message', 'Item added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function currency()
    {
        return view('accounting-tree.add-currency');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addCurrency(Request $request)
    {
        $treasuries = Treasury::all();

        $last_item = TreasuryCurrencies::orderby('id', 'desc')->first();
        $item = new TreasuryCurrencies();

        if(!is_null($last_item)){
            $new_level_code = str_pad($last_item->code + 1, 3, '0', STR_PAD_LEFT);
        }else{
            $new_level_code = "001";
        }
        $item->level = 5;
        $item->code = $new_level_code;
        $item->title = $request->input('title');
        $item->currency_code = $request->input('currency_code');
        $item->debit = true;
        $item->credit = false;
        $item->save();

        foreach ($treasuries as $treasury) {
            $currency = new Currency();
            $currency->treasury_id  = $treasury->id;
            $currency->treasury_currency_id = $item->id;
            $currency->code = $treasury->code."".$item->code;
            $currency->rate = 0.0;

            $currency->save();
        }
        return view('accounting-tree.add-currency')->with('message', 'Item added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getLevel(Request $request)
    {
        
    }

}
