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
        Schema::table('users', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable()->after('phone_number');
            $table->string('state')->nullable()->after('city');
            $table->string('address')->nullable()->after('state');
            $table->string('zip_code')->nullable()->after('address');
            $table->string('ip_address')->nullable()->after('referred_by');
            $table->text('user_agent')->nullable()->after('ip_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['date_of_birth', 'state', 'address', 'zip_code', 'ip_address', 'user_agent']);
        });
    }
};
