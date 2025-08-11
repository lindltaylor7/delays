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
        Schema::create('drills', function (Blueprint $table) {
            $table->id();

            $table->string('area', 100);
            $table->string('zone', 100);
            $table->string('bank', 100);
            $table->string('project', 150);

            $table->time('hour'); // Hora en formato HH:MM
            $table->string('operator', 150);
            $table->string('helper', 150);

            $table->decimal('hour_meter_diesel', 10, 2);
            $table->decimal('fuel', 10, 2);

            $table->enum('shift', ['DIA', 'NOCHE']);

            $table->string('supervisor_owm', 150);
            $table->string('supervisor_client', 150);
            $table->string('equipment', 150);

            $table->decimal('hour_start', 15, 4);
            $table->decimal('hour_end', 15, 4);
            $table->decimal('hours_worked', 15, 4);

            $table->decimal('total_hours', 15, 2);
            $table->integer('total_drills');

            $table->decimal('total_real_meters', 15, 2);
            $table->decimal('total_reconciled_meters', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drills');
    }
};
