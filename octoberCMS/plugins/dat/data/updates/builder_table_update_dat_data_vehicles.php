<?php namespace Dat\Data\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDatDataVehicles extends Migration
{
    public function up()
    {
        Schema::table('dat_data_vehicles', function($table)
        {
            $table->string('name')->nullable(false)->unsigned(false)->default(null)->comment(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('dat_data_vehicles', function($table)
        {
            $table->smallInteger('name')->nullable(false)->unsigned(false)->default(null)->comment(null)->change();
        });
    }
}
