<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('department_id');
            $table->string('name');
            $table->string('department_head_employee_id');
            $table->string('description')->nullable();
            $table->timestamps();
        });

         // Insert default values
         DB::table('departments')->insert(array('name' => 'Not Specified', 'department_head_employee_id' => 'Not Specified'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
