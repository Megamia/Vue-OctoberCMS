<?php namespace Dat\Data\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDatDataVehicles extends Migration
{
    public function up()
    {
        Schema::create('dat_data_vehicles', function($table)
        {
            $table->increments('id');
            $table->smallInteger('name');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dat_data_vehicles');
    }
}
