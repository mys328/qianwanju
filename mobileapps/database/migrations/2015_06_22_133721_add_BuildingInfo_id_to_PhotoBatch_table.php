<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBuildingInfoIdToPhotoBatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('PhotoBatch', function(Blueprint $table) {
            $table->integer('BuildingInfo_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('PhotoBatch', function(Blueprint $table) {
            $table->dropColumn('BuildingInfo_id');
        });
    }
}
