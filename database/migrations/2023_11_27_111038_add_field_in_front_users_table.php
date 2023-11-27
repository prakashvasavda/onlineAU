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
            $table->string('type_of_pet')->nullable()->after('what_do_you_need');
            $table->string('how_many_pets')->nullable()->after('what_do_you_need');
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
