<?php namespace App\Http\Controllers;

use DataEdit;
use DataGrid;
use View;
use App\BuildingInfo;
use App\Developer;
use App\PropertyCompany;
use App\PropertyType;
use App\BuildingType;
use Response;
use HTML;
use DB;

class BuildingInfoController extends Controller {

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
		$grid = DataGrid::source(BuildingInfo::with('developer'));

		$grid->add('Name','楼盘名称',true);

		$grid->add('{{ $developer->Name }}','开发商名称');

		$grid->edit('/index.php/buildinginfo/edit','修改','modify|delete');

		$grid->link('/buildinginfo/edit','创建楼盘信息','TR');

		$grid->orderBy('created_at','desc');

		$grid->paginate(10);

		return View::make('buildinginfo.list',compact('grid'));
	}

	public function edit()
	{
		$edit = DataEdit::source(new BuildingInfo);

		$edit->link("/buildinginfo","楼盘信息","TR");

		$edit->addText('Name',"楼盘名称")->rule('required');

		$edit->addImage('CoverImage','封面')
			 ->rule('required')
		     ->rule('mimes:jpeg')
		     ->move('uploads/coverimages/');

		 $edit->addText('Price','均价(元/平米)');

		 $edit->addText('DiscountInformation','优惠信息');

		 $edit->addText('Commission','佣金(元)');

		 $edit->addSelect('Expired','是否过期')->options([1=>'是',0=>'否']);

		 $edit->addDate('OpenTime','开盘日期')->format('d/m/Y', 'cn');

		 $edit->addSelect('Developer_id','开发商')->options(array_merge(['0'=>'--选择--'],Developer::lists('Name','id')));

		 $edit->addSelect('PropertyCompany_id','物业公司')->options(array_merge(['0'=>'--选择--'],PropertyCompany::lists('Name','id')));

		 $edit->addSelect('Fitment','装修情况')->options([''=>'--选择--','毛坯'=>'毛坯','精装'=>'精装']);

		 $edit->addSelect('PropertyType','物业类型')->options([''=>'--选择--','公寓'=>'公寓','别墅'=>'别墅','商铺'=>'商铺','写字楼'=>'写字楼']);

		 $edit->addSelect('BuildingType','楼盘类型')->options([''=>'--选择--','高层'=>'高层','小高层'=>'小高层']);

		 $edit->addText('DoorAmount','户数');

		 $edit->addText('StallAmount','车位数');

		 $edit->addText('Volume','容积率');

		 $edit->addText('GreenPercentage','绿化率');
		 
		 $edit->addRedactor('News','新闻动态');

		 $edit->saved(function() use ($edit) {
			$edit->message("添加成功");
		 });

		 return $edit->view('buildinginfo.edit',compact('edit'));
	}

	public function buildings($skip,$take)
	{
		$buildings = DB::table('BuildingInfo')->skip($skip)->take($take)->get();
		return Response::json($buildings);
	}

	public function building($id)
	{
		$building = BuildingInfo::with('developer','propertycompany')->find($id);

		return Response::json($building);
	}

	public function test()
	{
		$building = BuildingInfo::find(1);
		$building->PropertyTyp='测试';
		$building->save();
		var_dump($building);
	}
}
