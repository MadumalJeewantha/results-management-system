<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('grade');
            // There is only two decimal points
            $table->float('points',8,2);
            $table->timestamps();
        });

        // Insert default values
        DB::table('gradings')->insert(array('grade' => 'MC', 'points' => '0'));
        DB::table('gradings')->insert(array('grade' => 'DFR', 'points' => '0'));
        DB::table('gradings')->insert(array('grade' => 'AB', 'points' => '0'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gradings');
    }
}
