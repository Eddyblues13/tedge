<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->string('method')->default('crypto')->after('account_type')->comment('crypto or bank');
            $table->string('bank_name')->nullable()->after('wallet_address');
            $table->string('account_name')->nullable()->after('bank_name');
            $table->string('account_number')->nullable()->after('account_name');
            $table->string('routing_number')->nullable()->after('account_number');
            $table->string('swift_code')->nullable()->after('routing_number');
        });

        // Admin-created withdrawals stored the method in account_type
        DB::table('withdrawals')->where('account_type', 'bank')->update(['method' => 'bank']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->dropColumn(['method', 'bank_name', 'account_name', 'account_number', 'routing_number', 'swift_code']);
        });
    }
};
