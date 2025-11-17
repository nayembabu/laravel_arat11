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
        Schema::create('arat_deposits', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('institute_iddd')->nullable();
            $table->unsignedBigInteger('employee_info_iddd')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable(); 
            $table->date('deposit_date');
            $table->decimal('amount', 12, 2);
            $table->string('deposit_source')->nullable();
            $table->string('transaction_type')->nullable(); 
            $table->string('reference_number')->nullable(); 
            $table->string('cheque_number')->nullable();
            $table->date('cheque_date')->nullable();
            $table->string('voucher_no')->nullable();
            $table->unsignedBigInteger('received_by')->nullable(); 
            $table->unsignedBigInteger('deposited_by')->nullable(); 

            $table->enum('status', ['pending','approved','rejected'])->default('pending');

            $table->string('attachment')->nullable(); 

            $table->text('note')->nullable();

            $table->timestamps();

});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arat_deposits');
    }
};
