<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_registration_number');
            $table->string('student_index_number');
            $table->string('subject_code');
            $table->integer('grade'); // ID of grade from gradings table
            $table->integer('exam_year');
            $table->integer('credits');

            // There can be unpredicted decimal points

            //According to the Grade_table, it's 'points'          
            //$table->float('points_value',8,7); 
            $table->string('points_value'); 

            //GPV = Credits * Points_Value 
            //$table->float('gpv',8,7);
            $table->string('gpv');
        
            //Set publishied state 
            $table->boolean('published')->default(false);
            
            //To identify repeat subjects - for calculating GPA
            $table->boolean('repeat')->default(false);

            
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
        Schema::dropIfExists('grades');
    }
}
