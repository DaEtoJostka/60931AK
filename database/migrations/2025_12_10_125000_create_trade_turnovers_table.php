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
        Schema::create('trade_turnovers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id1')->constrained('countries')->onDelete('cascade');
            $table->foreignId('country_id2')->constrained('countries')->onDelete('cascade');
            $table->integer('year');
            $table->float('export_c1_to_c2')->nullable();
            $table->float('export_c2_to_c1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_turnovers');
    }
};
