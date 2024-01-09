<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cnic', 15)->unique()->after('email');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('phonenumber', 11)->unique()->after('cnic');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cnic');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phonenumber');
        });
    }
};