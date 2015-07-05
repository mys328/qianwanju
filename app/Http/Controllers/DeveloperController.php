<?php namespace App\Http\Controllers;

use DataEdit;
use DataGrid;
use View;
use Log;
use App\Developer;


class DeveloperController extends Controller {

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

	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$grid = DataGrid::source(new Developer);

		$grid->add('id','ID',true);

		$grid->add('Name','开发商名');

		$grid->edit('developer/edit','修改','modify|delete');

		$grid->link('developer/edit',"创建","TR");

		$grid->orderBy('id','asc');

		$grid->paginate(10);

		return View::make('developer.list',compact('grid'));
	}

	public function edit()
	{
		$edit = DataEdit::source(new Developer);

		//$edit->add('id','ID','integer');

		$edit->add('Name','开发商名','text')->rule('required');

		$edit->saved(function() use ($edit) {
			$edit->message("添加成功");

		});

		$edit->link("/developer","开发商列表","TR");

		return $edit->view('developer.edit',compact('edit'));
	}

	public function test()
	{
		$var = Developer::lists('Name','id');

		Log::info(var_dump($var));

		return null;
	}

}
