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
    Schema::create('medicines', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('generic_name')->nullable();
        $table->string('category');
        $table->string('supplier')->nullable();
        $table->integer('quantity');
        $table->integer('reorder_level')->default(10);
        $table->decimal('buying_price', 10, 2);
        $table->decimal('selling_price', 10, 2);
        $table->date('expiry_date');
        $table->string('batch_number')->nullable();
        $table->text('description')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
