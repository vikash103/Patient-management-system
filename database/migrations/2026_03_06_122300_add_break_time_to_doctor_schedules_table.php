<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('doctor_schedules', function (Blueprint $table) {

        $table->time('break_start')->nullable();
        $table->time('break_end')->nullable();

    });
}

public function down()
{
    Schema::table('doctor_schedules', function (Blueprint $table) {

        $table->dropColumn('break_start');
        $table->dropColumn('break_end');

    });
}

};
