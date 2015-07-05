<?php namespace App\Http\Controllers;

use App\BuildingInfo;
use Response;

class IonicController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$buildings = BuildingInfo::all();
		return view('ionic.index')->with('buildings',$buildings);
	}

	public function detail($id)
	{
		$building = BuildingInfo::find($id);

		return view('ionic.detail')->with('building',$building);
	}

	public function test()
	{
		/*$buildings = BuildingInfo::all();
		return Response::json($buildings);
		*/
		return view('ionic.test');
	}

}
