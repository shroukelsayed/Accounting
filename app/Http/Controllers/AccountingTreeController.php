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
use App\AdvancedExpenses;
use App\DepositsWithOthers;
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
use App\Taxes;
use App\Suppliers;

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
        //
        // var_dump($request->all());die;
        // var_dump($request->all());die;

        // $parentLevel = AccountingTreeLevelTwo::findOrFail($request->input('id'));


        // $level = new AccountingTreeLevelTwo();
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
                $level = new FixedAssets();
                $last_level = FixedAssets::orderby('id', 'desc')->first();
            }else if($request->input('parent_code') == '32'){
                $level = new FixedAssets();
                $last_level = FixedAssets::orderby('id', 'desc')->first();
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

        }elseif($request->input('parent_level') == '4'){
            if($request->input('parent_code') == '120201'){
                $level = new BankAccounts();
                $last_level = BankAccounts::orderby('id', 'desc')->first();
            }elseif($request->input('parent_code') == '121101'){
                $level = new FawryItems();
                $last_level = FawryItems::orderby('id', 'desc')->first();
            }

        }elseif($request->input('parent_level') == '5'){
            if($request->input('parent_code') == '120201001'){
                $level = new BankAccountItems();
                $last_level = BankAccountItems::orderby('id', 'desc')->first();
            }elseif($request->input('parent_code') == '121101002'){
                $level = new FawryBanks();
                $last_level = FawryBanks::orderby('id', 'desc')->first();
            }

        }




        if(!is_null($last_level)){
            $new_level_code = $last_level->code + 1;
        }else{
            if($request->input('parent_level') == '3' || $request->input('parent_level') == '2'){
                $new_level_code  = $request->input('parent_code')."01";
            }elseif($request->input('parent_level') == '4'){
                $new_level_code  = $request->input('parent_code')."001";
            }elseif($request->input('parent_level') == '5'){
                $new_level_code  = $request->input('parent_code')."0001";
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
        
        // var_dump($level);die();
        $level->save();

       
        return Redirect::back();
    }

}
