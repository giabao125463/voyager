<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDoctorNameToDoctorIdInAnketResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anket_results', function (Blueprint $table) {
            $table->renameColumn('doctor_name', 'doctor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anket_results', function (Blueprint $table) {
            $table->renameColumn('doctor_id', 'doctor_name');
        });
    }
}
