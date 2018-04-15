<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\AccountingTreeLevelOne;
use App\AccountingTreeLevelTwo;
use App\FixedAssets;
use App\CurrentAssets;
use App\CurrentLiabilities;
use App\Banks;
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
            if($request->input('parent_code') == '1201'){
                $level = new FixedAssets();
                $last_level = FixedAssets::orderby('id', 'desc')->first();
            }else if($request->input('parent_code') == '1202'){
                $level = new Banks();
                $last_level = Banks::orderby('id', 'desc')->first();
            }
        }

        // $new_level_code = 0;
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
