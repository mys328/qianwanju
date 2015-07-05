<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotoBatchIdToBuildingInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('BuildingInfo', function(Blueprint $table)
		{
			//
			$table->integer('PhotoBatch_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('BuildingInfo', function(Blueprint $table)
		{
			//
			
		});
	}

}
