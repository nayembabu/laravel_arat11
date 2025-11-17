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
        Schema::create('ins_saas_status', function (Blueprint $table) {
            $table->id();
            $table->string('enroll_dates')->nullable();
            $table->string('expire_dates')->nullable();
            $table->string('remarks')->nullable();
            $table->string('ins_id_auto')->nullable();
            $table->string('this_dates')->nullable();
            $table->string('this_times')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ins_saas_status');
    }
};
