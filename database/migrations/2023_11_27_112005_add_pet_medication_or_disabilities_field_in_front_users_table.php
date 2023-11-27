<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('front_users', function (Blueprint $table) {
            $table->string('pet_medication_or_disabilities', 10)->nullable()->after('what_do_you_need');
            $table->string('pet_medication_or_disabilities_specification', 100)->nullable()->after('what_do_you_need');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('front_users', function (Blueprint $table) {
            //
        });
    }
};
