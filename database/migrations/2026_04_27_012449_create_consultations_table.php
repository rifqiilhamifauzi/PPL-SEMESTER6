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
    Schema::create('consultations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained(); // Pasien
        $table->foreignId('lawyer_id')->constrained('users'); // Lawyer
        $table->text('brief_case'); // Ringkasan masalah dari user
        $table->string('status')->default('pending'); // pending, active, finished, cancelled
        $table->string('payment_status')->default('unpaid'); // Mengacu ke Midtrans
        $table->string('midtrans_snap_token')->nullable();
        $table->jsonb('metadata')->nullable(); // PostgreSQL JSONB untuk fleksibilitas data tambahan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
