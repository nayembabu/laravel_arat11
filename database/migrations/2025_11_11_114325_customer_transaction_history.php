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
        Schema::create('customer_transaction_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institute_iddd')->nullable();
            $table->unsignedBigInteger('employee_info_iddd')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->date('transaction_date')->nullable();
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('customer_address')->nullable(); 
            $table->string('customer_number')->nullable(); 
            $table->string('transaction_type')->nullable(); 
            $table->string('payment_method')->nullable();   
            $table->text('remarks')->nullable();
            $table->string('status')->default('completed'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_transaction_history');
    }
};
