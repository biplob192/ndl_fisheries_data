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
        Schema::create('fisheries_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('entry_id');
            $table->double('dissolved_oxygen', 8, 2)->nullable();
            $table->double('ph', 8, 2)->nullable();
            $table->double('turbidity', 8, 2)->nullable();
            $table->double('water_temperature', 8, 2)->nullable();
            $table->double('electrical_conductivity', 8, 2)->nullable();
            $table->timestamp('datetime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fisheries_data');
    }
};
