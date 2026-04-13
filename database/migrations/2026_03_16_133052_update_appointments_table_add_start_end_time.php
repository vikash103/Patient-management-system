<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Add new columns
            $table->time('start_time')->after('appointment_time')->nullable();
            $table->time('end_time')->after('start_time')->nullable();
            $table->text('notes')->after('status')->nullable();
        });

        // Copy existing appointment_time to start_time and set end_time to +30 minutes
        $appointments = DB::table('appointments')->get();
        foreach ($appointments as $appointment) {
            $startTime = $appointment->appointment_time;
            // Add 30 minutes to start time for end time
            $endTime = date('H:i:s', strtotime($startTime . ' +30 minutes'));
            
            DB::table('appointments')
                ->where('id', $appointment->id)
                ->update([
                    'start_time' => $startTime,
                    'end_time' => $endTime
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['start_time', 'end_time', 'notes']);
        });
    }
};