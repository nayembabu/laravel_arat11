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
        Schema::create('supplier_transaction_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institute_iddd')->nullable();
            $table->unsignedBigInteger('employee_info_iddd')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('supplier_name')->nullable();
            $table->date('transaction_date')->nullable();
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('supplier_address')->nullable(); 
            $table->string('supplier_number')->nullable(); 
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
        Schema::dropIfExists('supplier_transaction_history');
    }
};
