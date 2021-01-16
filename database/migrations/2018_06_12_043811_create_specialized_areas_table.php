<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecializedAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialized_areas', function (Blueprint $table) {
            $table->increments('specialized_area_id'); 
            $table->string('name');
            $table->string('description')->nullable();;
            $table->timestamps();
        });

        // Insert default values
        DB::table('specialized_areas')->insert(array('name' => 'Not Specified'));
  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialized_areas');
    }
}
