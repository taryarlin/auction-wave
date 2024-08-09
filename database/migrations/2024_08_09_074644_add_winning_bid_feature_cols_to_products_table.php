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
        Schema::table('products', function (Blueprint $table) {
            $table->string('winner_id')->nullable()->after('customer_id');
            $table->decimal('won_amount', 10, 2)->nullable()->after('winner_id');
            $table->timestamp('won_datetime')->nullable()->after('won_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['winner_id', 'won_amount', 'won_datetime']);
        });
    }
};
