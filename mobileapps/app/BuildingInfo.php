<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingInfo extends Model {

	//

	protected $table = 'BuildingInfo';

	public function developer()
	{
		return $this->belongsTo('App\Developer','Developer_id');
	}


	public function propertyCompany()
	{
		return $this->belongsTo('App\PropertyCompany','PropertyCompany_id');
	}

	public function photo()
	{
		return $this->hasMany('App\PhotoBatch','PhotoBatch_id');
	}
}
