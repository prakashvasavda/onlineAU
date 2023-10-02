<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFrontUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('age');
            $table->string('profile');
            $table->string('id_number');
            $table->string('contact_number');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('situated');
            $table->string('area');
            $table->string('gender');
            $table->string('ethnicity');
            $table->string('religion');
            $table->string('home_language');
            $table->string('additional_language');
            $table->string('disabilities');
            $table->string('marital_status');
            $table->string('dependants');
            $table->string('chronical_medication');
            $table->string('drivers_license');
            $table->string('vehicle');
            $table->string('car_accident');
            $table->string('childcare_experience');
            $table->string('experience_special_needs');
            $table->string('salary_expectation');
            $table->string('available_day');
            $table->string('status');
            $table->string('role');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('front_users');
    }
}
