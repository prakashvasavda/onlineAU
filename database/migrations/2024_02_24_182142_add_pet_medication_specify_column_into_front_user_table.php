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
            $table->text('pet_medication_specify')->nullable()->after('pet_medication_or_disabilities');
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
