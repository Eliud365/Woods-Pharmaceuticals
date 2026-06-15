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
    Schema::create('sales', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('receipt_number')->unique();
        $table->decimal('total_amount', 10, 2);
        $table->decimal('amount_paid', 10, 2);
        $table->decimal('change_given', 10, 2)->default(0);
        $table->enum('payment_method', ['cash', 'mpesa', 'insurance'])->default('cash');
        $table->string('customer_name')->nullable();
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
