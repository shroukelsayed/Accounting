<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller {


	public function __construct()
	{
		// $this->middleware('auth',['except' =>[ 'show','create','store']]);
		$this->middleware('admin',['only' =>[ 'index']]);
	    
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::orderBy('id', 'desc')->paginate(10);

		return view('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$user = new User();
		// var_dump($request);die;
		
		$user->role = 2;
		$user->save();

		return redirect()->route('users.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);
		$role = Role::findOrFail($user->role);

		return view('users.show', compact('user','role'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);

		return view('users.edit', compact('user'));
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
		$user = User::findOrFail($id);

		// var_dump($request->all());die;
		$user->name = $request['user_name'];
		$user->email = $request['email'];
		$user->password = md5($request['password']);
		$user->role = (int)$request['role'];

		$user->save();

		return redirect()->route('users.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::findOrFail($id);
		$user->delete();

		return redirect()->route('users.index')->with('message', 'Item deleted successfully.');
	}

}
