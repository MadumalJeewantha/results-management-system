<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('student_registration_number')->primary(); 
            $table->string('student_index_number'); 
            $table->integer('department_id')->nullable();
            $table->integer('course_id');
            $table->integer('academic_year_id');
            $table->integer('specialized_area_id')->nullable();
            $table->string('initials');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('nic_number');
            $table->string('date_of_birth');
            $table->string('gender');
            $table->string('marriage_state');
            $table->string('email')->nullable();
            $table->string('contact_no_mobile')->nullable();
            $table->string('contact_no_home')->nullable();
            $table->string('home_address_1')->nullable();
            $table->string('home_address_2')->nullable();
            $table->string('home_address_3')->nullable();
            $table->string('current_address_1')->nullable();
            $table->string('current_address_2')->nullable();
            $table->string('current_address_3')->nullable();
            $table->string('fb_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('number_of_sisters_and_brothers')->nullable();
            $table->string('dissertation_title')->nullable();
            $table->string('dissertation_published_link')->nullable();
            $table->string('supervisor_name')->nullable();
            $table->string('profile_picture')->nullable();
            $table->longtext('bio')->nullable();

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
        Schema::dropIfExists('students');
    }
}
