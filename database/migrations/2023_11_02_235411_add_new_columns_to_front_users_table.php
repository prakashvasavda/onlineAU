<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToFrontUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('front_users', function (Blueprint $table) {
            $table->string('south_african_citizen')->after('family_special_need_value')->nullable();
            $table->string('working_permit')->after('south_african_citizen')->nullable();
            $table->string('ages_of_children_you_worked_with')->after('working_permit')->nullable();
            $table->string('first_aid')->after('ages_of_children_you_worked_with')->nullable();
            $table->string('smoker_or_non_smoker')->after('first_aid')->nullable();
            $table->string('available_date')->after('smoker_or_non_smoker')->nullable();
            $table->string('about_yourself')->after('available_date')->nullable();
            $table->string('comfortable_with_light_housework')->after('about_yourself')->nullable();
            $table->string('petrol_reimbursement')->after('comfortable_with_light_housework')->nullable();
            $table->string('experience_with_animals')->after('petrol_reimbursement')->nullable();
            $table->string('do_you_like_animals')->after('experience_with_animals')->nullable();
            $table->string('surname')->after('name')->nullable();
            $table->string('terms_and_conditions')->after('email_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('front_users', function (Blueprint $table) {
            //
        });
    }
}
