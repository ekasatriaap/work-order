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
        Schema::create('task_hd', function (Blueprint $table) {
            $table->id();
            $table->string("no_wo", 191)->unique()->index()->comment("Nomor Work Order");
            $table->foreignId("id_pemberi_tugas")->constrained("users", "id")->setNullOnDelete();
            $table->foreignId("id_penerima_tugas")->constrained("users", "id")->setNullOnDelete();
            $table->dateTime("deadline");
            $table->dateTime("waktu_mulai")->nullable();
            $table->dateTime("waktu_selesai")->nullable();
            $table->enum("status", ["pending", "in_progress", "completed", "canceled"])->default("pending");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks_hds');
    }
};
