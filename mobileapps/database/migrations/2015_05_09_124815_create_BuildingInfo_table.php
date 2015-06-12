<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('BuildingInfo', function(Blueprint $table) {
            $table->increments('id');
            $table->string('Name');
            $table->string('CoverImage');
            $table->integer('Price');
            $table->string('DiscountInformation')->nullable();
            $table->integer('Commission')->nullable();
            $table->text('News')->nullable();
            $table->boolean('Expired')->default(true);
            $table->date('OpenTime')->nullable();
            $table->integer('Developer_id')->nullable();
            //$table->foreign('Developer_id')->references('id')->on('Developer_lkp');
            $table->integer('PropertyCompany_id')->nullable();
            //$table->foreign('PropertyCompany_id')->references('id')->on('PropertyCompany_lkp');
            
            $table->string('PropertyType')->nullable();
            $table->string('BuildingType')->nullable();

            $table->string('Fitment')->nullable();
            $table->integer('DoorAmount')->nullable();
            $table->integer('StallAmount')->nullable();
            $table->float('Volume')->nullable();
            $table->float('GreenPercentage')->nullable();
            $table->float('PropertyFee')->nullable();
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('BuildingInfo');
	}

}
