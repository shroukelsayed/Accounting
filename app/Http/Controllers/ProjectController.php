<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Validator;

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
	        'code' => 'required|unique:projects',
	    ));
	    if($validator->fails()) {
	        return Redirect::back()
	            ->withErrors($validator)
	            ->WithInput();
	    }


		$project = new Project();

		$project->name = $request->input('name');
		$project->code = $request->input('code');
		$project->user_id = Auth::user()->id;
		$project->published_at = Carbon::now();

		$project->save();

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
