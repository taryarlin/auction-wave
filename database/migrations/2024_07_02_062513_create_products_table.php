<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->morphs('ownerable');
            $table->string('name');
            $table->foreignIdFor(Category::class)->constrained()->onDelete('cascade');
            $table->longText('description');
            $table->longText('delivery_option');
            $table->decimal('starting_price', 10, 2);
            $table->decimal('fixed_price', 10, 2)->nullable();
            $table->timestamp('start_datetime');
            $table->timestamp('end_datetime');
            $table->integer('buyer_premium_percent');
            $table->integer('bid_increment');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('listing_id');
            $table->string('item_number');
            $table->longText('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
