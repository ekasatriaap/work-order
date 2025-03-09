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
        Schema::table('task_dt', function (Blueprint $table) {
            $table->after("jumlah", fn($table) => $table->integer("jumlah_real")->nullable()->comment("Jumlah realisasi"));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_dt', function (Blueprint $table) {
            //
        });
    }
};
