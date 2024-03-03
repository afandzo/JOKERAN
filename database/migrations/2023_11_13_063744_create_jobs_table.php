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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_code')->unique();
            $table->foreignId('boss_id');
            $table->date('start_date');
            $table->date('payment_date')->nullable();
            $table->enum('payment_status', ['belum bayar', 'dibayar'])->default('belum bayar');
            $table->integer('total_payment')->default(0);
            $table->foreignId('admin_id');
            $table->timestamps();

            $table->foreign('boss_id')->references('id')->on('bosses');
            $table->foreign('admin_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
