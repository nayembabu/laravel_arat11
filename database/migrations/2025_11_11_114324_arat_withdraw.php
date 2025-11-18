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
        Schema::create('arat_withdraw', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institute_iddd')->nullable();
            $table->unsignedBigInteger('employee_info_iddd')->nullable();
            $table->date('withdraw_date');
            $table->decimal('amount', 12, 2);
            $table->string('withdraw_source')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('received_by')->nullable(); 
            $table->string('withdrawed_by')->nullable(); 
            $table->enum('status', ['pending','approved','rejected'])->default('pending');
            $table->text('remarks')->nullable();
            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arat_withdraw');
    }
};
