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
        Schema::create('employee_details', function (Blueprint $table) {
            $table->id();
            $table->string('emp_full_name')->nullable();
            $table->string('emp_father_name')->nullable();
            $table->string('emp_mother_name')->nullable();
            $table->string('emp_address')->nullable();
            $table->string('emp_nid')->nullable();
            $table->string('emp_dob')->nullable();
            $table->string('emp_mobile')->nullable();
            $table->string('emp_desig')->nullable();
            $table->string('ins_idd')->nullable();
            $table->string('added_user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_details');
    }
};
