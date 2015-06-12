<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoBatchDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PhotoBatchDetail', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('Batch_id');
            $table->string('ImgUrl');
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
		Schema::drop('PhotoBatchPhotoBatchDetail');
	}

}
