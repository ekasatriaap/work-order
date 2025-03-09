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
        Schema::create('task_dt', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_task_hd")->constrained("task_hd", "id")->cascadeOnDelete();
            $table->foreignId("id_produk")->constrained("produks", "id")->cascadeOnDelete();
            $table->integer("jumlah");
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
        Schema::dropIfExists('task_dts');
    }
};
