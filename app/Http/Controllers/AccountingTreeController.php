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
        $user = User::findOrFail($id);
        $role = Role::findOrFail($user->role);

        return view('accounting-tree.show', compact('user','role'));
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
        var_dump($request->all());die;

        // $parentLevel = AccountingTreeLevelTwo::findOrFail($request->input('id'));


        // $level = new AccountingTreeLevelTwo();
        if($request->input('parent_code') == '11'){
            $level = new FixedAssets();
        }else if($request->input('parent_code') == '12'){
            $level = new CurrentAssets();
        }else if($request->input('parent_code') == '21'){
            $level = new CurrentLiabilities();
        }else if($request->input('parent_code') == '31'){
            $level = new FixedAssets();
        }else if($request->input('parent_code') == '32'){
            $level = new FixedAssets();
        }

        
        $level->level = $request->input('parent_level') +1;
        $level->parent = $request->input('parent_id');
        $level->code = $request->input('parent_code').$request->input('level_code');
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

       
        return redirect()->route('accounting-tree.index')->with('message', 'Item created successfully.');
    }

}
